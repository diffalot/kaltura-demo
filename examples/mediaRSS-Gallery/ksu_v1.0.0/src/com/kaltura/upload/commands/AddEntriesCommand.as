/*
// ===================================================================================================
//                           _  __     _ _
//                          | |/ /__ _| | |_ _  _ _ _ __ _
//                          | ' </ _` | |  _| || | '_/ _` |
//                          |_|\_\__,_|_|\__|\_,_|_| \__,_|
//
// This file is part of the Kaltura Collaborative Media Suite which allows users
// to do with audio, video, and animation what Wiki platfroms allow them to do with
// text.
//
// Copyright (C) 2006-2008  Kaltura Inc.
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU Affero General Public License as
// published by the Free Software Foundation, either version 3 of the
// License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU Affero General Public License for more details.
//
// You should have received a copy of the GNU Affero General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.
//
// @ignore
// ===================================================================================================
*/
package com.kaltura.upload.commands
{
	import com.kaltura.net.TemplateURLVariables;
	import com.kaltura.upload.business.PartnerNotificationVO;
	import com.kaltura.upload.events.KUploadErrorEvent;
	import com.kaltura.upload.events.KUploadEvent;
	import com.kaltura.upload.vo.FileVO;

	import flash.events.Event;
	import flash.events.IOErrorEvent;
	import flash.events.SecurityErrorEvent;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.net.URLRequestMethod;

	public class AddEntriesCommand extends BaseUploadCommand
	{
		private var _loader:URLLoader = new URLLoader

		public function AddEntriesCommand():void
		{
			_loader.addEventListener(Event.COMPLETE, 					loaderCompleteHandler);
			_loader.addEventListener(IOErrorEvent.IO_ERROR, 			ioErrorHandler);
			_loader.addEventListener(SecurityErrorEvent.SECURITY_ERROR, securityErrorHandler);
		}
		override public function execute():void
		{
			if (model.error)
			{
				throw new Error("Cannot add entries, some uploads failed. Either re-upload or remove the files");
				return;
			}
			var urlVars:TemplateURLVariables = getUrlVars();
			var request:URLRequest = new URLRequest(model.addEntryUrl);
			request.method = URLRequestMethod.POST;
			request.data = urlVars;
			_loader.load(request);
			//new TemplateURLVariables(model.baseRequestData);

		}

		private function loaderCompleteHandler(e:Event):void
		{
			try
			{
				var resultXml:XML = XML(_loader.data);
		   		var entriesXmlList:XMLList = resultXml.result.entries.children();

		   		var entryIdListArray:Array = new Array();
		   		var i:int = 0;
		   		for each (var entryXml:XML in entriesXmlList)
		   		{
		   			FileVO(model.files[i++]).entryId = entryXml.id[0].toString();
		   		}

				var notificationVoList:Array = getNotificationsList(resultXml);

			}
			catch(e:Error)
			{
				dispatchAddEntryError();
			}

			if (notificationVoList.length > 0)
			{
				var sendNotifications:SendNotificationsCommand = new SendNotificationsCommand(notificationVoList);
				sendNotifications.execute();
			}
			else
			{
		   		var notifyShell:NotifyShellCommand = new NotifyShellCommand(KUploadEvent.ENTRIES_ADDED, model.files);
		   		notifyShell.execute();
			}
		}

		private function getUrlVars():TemplateURLVariables
		{
			var urlVars:TemplateURLVariables = new TemplateURLVariables(model.baseRequestData);
			urlVars["quick_edit"] = model.quickEdit.toString();
			urlVars["kshow_id"] = model.entryId;

			if (model.screenName)
				urlVars["credits_screen_name"] 	= model.screenName;
	   		if (model.siteUrl)
	   			urlVars["credits_site_url"] 	= model.siteUrl;

			var files:Array = model.files;
			files.forEach(
				function(fileVo:FileVO, index:int, filesList:Array):void
				{
					var entryIdx:int = index + 1;
					urlVars["entry" + entryIdx + "_filename"]		= fileVo.guid;
					urlVars["entry" + entryIdx + "_realFilename"] 	= "." + fileVo.extension;

					if (fileVo.mediaTypeCode)
						urlVars["entry" + entryIdx + "_mediaType"]	= fileVo.mediaTypeCode;
					if (fileVo.entryType)
						urlVars["entry" + entryIdx + "_type"]		= fileVo.entryType;
					urlVars["entry" + entryIdx + "_source"] 	= "1"; //upload
					if (fileVo.tags.length > 0)
						urlVars["entry" + entryIdx + "_tags"]		= fileVo.tags.join(",");
					urlVars["entry" + entryIdx + "_name"] 		= fileVo.title;
					if (model.partnerData)
						urlVars["entry" + entryIdx + "_partnerData"] = model.partnerData;

					if (model.groupId)
						urlVars["entry" + entryIdx + "_groupId"] = model.groupId;
					if (model.permissions)
						urlVars["entry" + entryIdx + "_permission"] = model.permissions;

					urlVars["entry" + entryIdx + "_conversionProfile"] = model.conversionProfile;
				}
			);

			return urlVars;
		}

		private function ioErrorHandler(e:IOErrorEvent):void
		{
			dispatchAddEntryError();
		}

		private function securityErrorHandler(e:SecurityErrorEvent):void
		{
			dispatchAddEntryError();
		}

		private function getNotificationsList(resultXml:XML):Array
		{
			var xmllNotification:XMLList = XML(resultXml.result.notifications[0]).children();

			var notifications:Array = [];
			for each(var xmlNotification:XML in xmllNotification)
			{
				var url:String 			= xmlNotification["url"].toString();
				var queryString:String	= xmlNotification["params"].toString();
				var notificationVO:PartnerNotificationVO = new PartnerNotificationVO(url, queryString);
				notifications.push(notificationVO);
			}

	   		return notifications;
	 	}

	 	private function dispatchAddEntryError():void
		{
			var notifyShell:NotifyShellCommand = NotifyShellCommand(KUploadErrorEvent.ADD_ENTRY_FAILED);
			notifyShell.execute();
		}
	}
}