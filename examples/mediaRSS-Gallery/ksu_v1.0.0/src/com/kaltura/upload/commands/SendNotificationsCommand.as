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
	import com.kaltura.upload.business.PartnerNotificationVO;
	import com.kaltura.upload.events.KUploadEvent;

	import flash.events.Event;
	import flash.events.IOErrorEvent;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.net.URLRequestMethod;
	import flash.net.URLVariables;
	import flash.utils.clearTimeout;
	import flash.utils.setTimeout;

	public class SendNotificationsCommand extends BaseUploadCommand
	{
		private static const TIMEOUT:int = 30e3;

		private var _requestsLeft:int;

		private var _timeoutId:uint;
		private var _notifications:Array;

		public function SendNotificationsCommand(notificationVoList:Array):void
		{
			_notifications = notificationVoList;
		}

		override public function execute():void
		{
			_requestsLeft = _notifications.length;
			_notifications.forEach(sendNotification);
			_timeoutId = setTimeout(sendNotificationsComplete, TIMEOUT);
		}

		private function sendNotification(partnerNotificationVo:PartnerNotificationVO, index:int, list:Array):void
		{
			var urlLoader:URLLoader = new URLLoader();
			var requestData:URLVariables = new URLVariables(partnerNotificationVo.queryString);
			var request:URLRequest = new URLRequest(partnerNotificationVo.url);
			request.data = requestData;
			request.method = URLRequestMethod.POST;
			urlLoader.addEventListener(Event.COMPLETE, 			loaderCompleteHandler);
			urlLoader.addEventListener(IOErrorEvent.IO_ERROR,	ioErrorHandler);
			urlLoader.load(request);

		}

		private function loaderCompleteHandler(completeEvent:Event):void
		{
			notificationSent();
		}


		private function ioErrorHandler(ioErrorEvent:Event):void
		{
			trace("send notifications io error");
			notificationSent();
		}

		private function dispose():void
		{
			clearTimeout(_timeoutId);
		}

		private function notificationSent():void
		{
			if (--_requestsLeft == 0)
			{
				sendNotificationsComplete();
			}
		}

		private function sendNotificationsComplete():void
		{
			dispose();
			var notifyShell:NotifyShellCommand = new NotifyShellCommand(KUploadEvent.ENTRIES_ADDED, model.files);
	   		notifyShell.execute();
		}

	}
}