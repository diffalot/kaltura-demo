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
package {
	import com.kaltura.upload.commands.AddEntriesCommand;
	import com.kaltura.upload.commands.AddTagsCommand;
	import com.kaltura.upload.commands.BaseUploadCommand;
	import com.kaltura.upload.commands.BrowseCommand;
	import com.kaltura.upload.commands.InitCommand;
	import com.kaltura.upload.commands.RemoveFilesCommand;
	import com.kaltura.upload.commands.SetMediaTypeCommand;
	import com.kaltura.upload.commands.SetTagsCommand;
	import com.kaltura.upload.commands.SetTitleCommand;
	import com.kaltura.upload.commands.SetDescriptionCommand;
	import com.kaltura.upload.commands.StopUploadsCommand;
	import com.kaltura.upload.commands.UploadCommand;
	import com.kaltura.upload.commands.ValidateLimitationsCommand;
	import com.kaltura.upload.enums.KUploadStates;
	import com.kaltura.upload.model.KUploadModelLocator;

	import flash.display.MovieClip;
	import flash.display.Sprite;
	import flash.display.StageAlign;
	import flash.display.StageScaleMode;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.external.ExternalInterface;
	import flash.system.Security;
	import flash.ui.ContextMenu;
	import flash.ui.ContextMenuItem;
	import flash.utils.setTimeout;

	public class KUpload extends Sprite
	{

		private var _model:KUploadModelLocator = KUploadModelLocator.getInstance();
		public function KUpload()
		{
			init();
		}

		private function init():void
		{
			Security.allowDomain("*");
			addEventListener(Event.ADDED_TO_STAGE, addedToSatgeHandler);

		}

		private function addedToSatgeHandler(addedToStageEvent:Event):void
		{
			removeEventListener(Event.ADDED_TO_STAGE, addedToSatgeHandler);
			drawFakeBg();

			var initCommand:BaseUploadCommand = new InitCommand(loaderInfo.parameters);
			initCommand.execute();
			stage.addEventListener(MouseEvent.CLICK, clickHandler);

			addCallbacks();

			this.contextMenu = new ContextMenu();
			this.contextMenu.customItems = [new ContextMenuItem("KUpload v.1.0.6")];
		}

		private function drawFakeBg():void
		{
		    var bg:MovieClip = new MovieClip();
		    bg.graphics.beginFill(0xFF0000, 0);
		    bg.graphics.drawRect(0, 0, 1024, 1024);
		    bg.x = 0;
		    bg.y = 0;
		    bg.width = 1024;
		    bg.height = 1024;
		    bg.graphics.endFill();
		    bg.buttonMode = true;
		    bg.useHandCursor = true;
		    addChild(bg);
		    stage.align = StageAlign.TOP_LEFT
		    stage.scaleMode = StageScaleMode.NO_SCALE
		}
		private function clickHandler(clickEvent:MouseEvent):void
		{
			if (_model.state == KUploadStates.READY)
			{
				browse();
			}
		}

		//API functions
		public function browse():void
		{
			trace("browse()");
			var browseCommand:BrowseCommand = new BrowseCommand();
			browseCommand.execute();
		}

		public function addTags(tags:Array, startIndex:int, endIndex:int):void
		{
			var addTagsCommand:AddTagsCommand = new AddTagsCommand(tags, startIndex, endIndex);
			setTimeout(function():void{ addTagsCommand.execute() }, 0);
		}

		public function setTags(tags:Array, startIndex:int, endIndex:int):void
		{
			var setTagsCommand:SetTagsCommand = new SetTagsCommand(tags, startIndex, endIndex);
			setTimeout(function():void{ setTagsCommand.execute() }, 0);
		}

		public function setTitle(title:String, startIndex:int, endIndex:int):void
		{
			var setTitleCommand:SetTitleCommand = new SetTitleCommand(title, startIndex, endIndex);
			setTimeout(function():void{ setTitleCommand.execute() }, 0);
		}
    
    public function setDescription(description:String, startIndex:int, endIndex:int):void
		{
			var setDescriptionCommand:SetDescriptionCommand = new SetDescriptionCommand(description, startIndex, endIndex);
			setTimeout(function():void{ setDescriptionCommand.execute() }, 0);
		}
		
    public function removeFiles(startIndex:int, endIndex:int):void
		{
			var setTitleCommand:RemoveFilesCommand = new RemoveFilesCommand(startIndex, endIndex);
			setTitleCommand.execute();
		}

		public function upload():void
		{
			var uploadCommand:UploadCommand = new UploadCommand();
			setTimeout(function():void{ uploadCommand.execute() }, 0);
		}

		public function setMediaType(mediaType:String):void
		{
			var setMediaTypeCommand:SetMediaTypeCommand = new SetMediaTypeCommand(mediaType);
			setTimeout(function():void{ setMediaTypeCommand.execute() }, 0);
		}

		public function addEntries():void
		{
			var addEntries:AddEntriesCommand = new AddEntriesCommand();
			setTimeout(function():void{ addEntries.execute() }, 0);
		}

		public function getFiles():Array
		{
			return _model.files;
		}

		public function getTotalSize():uint
		{
			return _model.totalSize;
		}

		public function stopUploads():void
		{
			var stopUploadsCommand:BaseUploadCommand = new StopUploadsCommand();
			stopUploadsCommand.execute()
		}

		public function getError():String
		{
			return _model.error;
		}

		public function getExceedingFilesIndices():Array
		{
			return _model.exceedingFilesIndices;
		}

		public function getUploadedErrorIndices():Array
		{
			return _model.uploadedErrorIndices;
		}

		public function setMaxUploads(value:uint):void
		{
			_model.maxUploads = value;
			var validateLimitations:ValidateLimitationsCommand = new ValidateLimitationsCommand();
			validateLimitations.execute();
		}

		public function setPartnerData(value:String):void
		{
			_model.partnerData = value;
		}

		public function setGroupId(value:String):void
		{
			_model.groupId = value;
		}

		public function setPermissions(value:String):void
		{

			_model.permissions = value;
		}

		public function setSiteUrl(value:String):void
		{
			_model.siteUrl = value;

		}

		public function setScreenName(value:String):void
		{
			_model.screenName = value;

		}

		private function addCallbacks():void
		{
			ExternalInterface.addCallback("upload", 	upload);
			ExternalInterface.addCallback("addEntries", addEntries);
			ExternalInterface.addCallback("setMediaType", setMediaType);
			ExternalInterface.addCallback("setTags", setTags);
			ExternalInterface.addCallback("addTags", addTags);
			ExternalInterface.addCallback("setTitle", setTitle);
			ExternalInterface.addCallback("getFiles", getFiles);
			ExternalInterface.addCallback("removeFiles", removeFiles);
			ExternalInterface.addCallback("getTotalSize", getTotalSize);
			ExternalInterface.addCallback("stopUploads", stopUploads);
			ExternalInterface.addCallback("getError", getError);
			ExternalInterface.addCallback("getExceedingFilesIndices", getExceedingFilesIndices);
			ExternalInterface.addCallback("getUploadedErrorIndices", getUploadedErrorIndices);
			ExternalInterface.addCallback("setMaxUploads", setMaxUploads);
			ExternalInterface.addCallback("setPartnerData", setPartnerData);

			ExternalInterface.addCallback("setGroupId", setGroupId);
			ExternalInterface.addCallback("setPermissions", setPermissions);
			ExternalInterface.addCallback("setSiteUrl", setSiteUrl);
			ExternalInterface.addCallback("setScreenName", setScreenName);
		}
	}
}
