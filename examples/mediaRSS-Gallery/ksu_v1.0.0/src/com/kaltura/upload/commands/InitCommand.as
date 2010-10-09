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
	import com.kaltura.upload.enums.KUploadStates;
	import com.kaltura.upload.events.KUploadErrorEvent;
	import com.kaltura.upload.events.KUploadEvent;
	import com.kaltura.upload.vo.FileFilterVO;
	import com.kaltura.utils.KConfigUtil;

	import flash.events.Event;
	import flash.events.IOErrorEvent;
	import flash.events.SecurityErrorEvent;
	import flash.net.FileFilter;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.utils.Dictionary;

	public class InitCommand extends BaseUploadCommand
	{
		private var _prams:Object;
		private var _configLoader:URLLoader;

		public function InitCommand(params:Object)
		{
			_prams = params;
		}

		override public function execute():void
		{
			model.state = KUploadStates.INITIALIZING;
			saveBaseFlashVars();

			setModelData();
			loadConfiguration();
		}

		private function saveBaseFlashVars():void
		{
			model.host		= _prams.host;
			model.ks 		= _prams.ks;
			model.partnerId = _prams.partnerId;
			model.subPId 	= _prams.subPId;
			model.uid 		= _prams.uid;
			model.entryId	= _prams.entryId;
			model.partnerData	= _prams.partnerData;
			model.uiConfId	= _prams.uiConfId;
			model.jsDelegate = _prams.jsDelegate;

			model.permissions 	= _prams.permissions;
			model.groupId 		= _prams.groupId;
			model.siteUrl 		= _prams.siteUrl;
			model.screenName 	= _prams.screenName;
		}



		private function setModelData():void
		{
			model.baseRequestData =
				{
					ks: 		model.ks,
					partner_id: model.partnerId,
					subp_id: 	model.subPId,
					uid: 		model.uid
				};
			model.uploadUrl  	= model.host + "/index.php/partnerservices2/upload";
			model.addEntryUrl 	= model.host + "/index.php/partnerservices2/addentry";

		}
		private function loadConfiguration():void
		{
			var uiConfUrl:String = model.host + "/index.php/partnerservices2/getuiconf"
			//var uiConfUrl = "http://localhost/sf/uiconf.xml"
			var urlRequest:URLRequest = new URLRequest(uiConfUrl);
			var data:TemplateURLVariables = new TemplateURLVariables(model.baseRequestData);
			data.ui_conf_id = model.uiConfId;

			urlRequest.data = data;
			_configLoader = new URLLoader(urlRequest)
			_configLoader.addEventListener(Event.COMPLETE, 						configLoaderCompleteHandler);
			_configLoader.addEventListener(IOErrorEvent.IO_ERROR, 				configLoaderIoErrorHandler);
			_configLoader.addEventListener(SecurityErrorEvent.SECURITY_ERROR,	configLoaderSecurityErrorHandler);
		}

		private function configLoaderCompleteHandler(e:Event):void
		{
			parseConfiguration();
			saveConfigurationFlashVars();
			kuploadReady()
		}
		private function parseConfiguration():void
		{
			var xmlUiConf:XML = XML(_configLoader.data);
			if (xmlUiConf.error.hasComplexContent())
			{
				dispatchUiConfError();
				return;
			}
			var configXml:XML = XML(unescape(xmlUiConf..confFile.text()));
			var xmlFileFilters:XML = configXml.fileFilters[0];
			var fileFilters:Dictionary = new Dictionary();

			for each (var xmlFileFilter:XML in xmlFileFilters.fileFilter)
			{
				var description:String = xmlFileFilter.@description;
				var extensions:String = xmlFileFilter.@extensions;

				var singlefileFilter:FileFilter = new FileFilter(description, extensions);
				var entryType:String = xmlFileFilter.@entryType;
				var mediaType:String = xmlFileFilter.@mediaType;
				var fileFilterVo:FileFilterVO = new FileFilterVO(singlefileFilter, mediaType, entryType);

				fileFilters[xmlFileFilter.@id.toString()] = fileFilterVo;
			}
			model.fileFilterVoList = fileFilters;
			model.activeFileFilterVO = fileFilters[xmlFileFilters.@default.toString()];

			var xmlLimits:XML = configXml.limits[0];
			model.maxUploads 	= KConfigUtil.getDefaultValue(xmlLimits.@maxUploads[0], model.maxUploads);
			model.maxFileSize 	= KConfigUtil.getDefaultValue(xmlLimits.@maxFileSize[0], model.maxFileSize);
			model.maxTotalSize	= KConfigUtil.getDefaultValue(xmlLimits.@maxTotalSize[0], model.maxTotalSize);

			model.conversionProfile	= KConfigUtil.getDefaultValue(configXml.@conversionProfile[0], model.conversionProfile);


		}

		private function configLoaderIoErrorHandler(e:IOErrorEvent):void
		{
			dispatchUiConfError();
		}

		private function configLoaderSecurityErrorHandler(e:IOErrorEvent):void
		{
			dispatchUiConfError();
		}

		private function dispatchUiConfError():void
		{
			var notifyShell:NotifyShellCommand = new NotifyShellCommand(KUploadErrorEvent.UI_CONF_ERROR);
			notifyShell.execute();
		}


		private function kuploadReady():void
		{
			model.state = KUploadStates.READY
			var notifyShellCommand:NotifyShellCommand = new NotifyShellCommand(KUploadEvent.READY);
			notifyShellCommand.execute();
		}

		private function saveConfigurationFlashVars():void
		{
			model.quickEdit		= KConfigUtil.getDefaultValue(_prams.quickEdit, model.quickEdit);
			model.maxFileSize	= KConfigUtil.getDefaultValue(_prams.maxFileSize, 	model.maxFileSize);
			model.maxTotalSize	= KConfigUtil.getDefaultValue(_prams.maxTotalSize, 	model.maxTotalSize);
			model.maxUploads	= KConfigUtil.getDefaultValue(_prams.maxUploads, 	model.maxUploads);
			model.conversionProfile	= KConfigUtil.getDefaultValue(_prams.conversionProfile, model.conversionProfile);
		}

	}
}