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
	import com.kaltura.net.PolledFileReference;
	import com.kaltura.upload.events.KUploadEvent;
	import com.kaltura.upload.vo.FileVO;
	
	import flash.events.Event;
	import flash.net.FileReference;
	import flash.net.FileReferenceList;

	public class BrowseCommand extends BaseUploadCommand
	{
		private var _fileReferenceList:FileReferenceList;
		private var _singlefileReference:FileReference; //for cases where the limit is set to single file

		private var _files:Array; /*of FileReference*/

		override public function execute():void
		{
			var fileFilters:Array = [model.activeFileFilterVO.fileFilter];
			if (model.maxUploads != 1)
			{
				_fileReferenceList = new FileReferenceList();
				_fileReferenceList.addEventListener(Event.SELECT, filesSelectHandler);
				_fileReferenceList.browse(fileFilters);
			}
			else
			{
				_singlefileReference = new FileReference();
				_singlefileReference.addEventListener(Event.SELECT, filesSelectHandler);
				_singlefileReference.browse(fileFilters);
			}
		}

		private function filesSelectHandler(selectEvent:Event):void
		{
			var files:Array = []; /*of FileReference*/
			if (selectEvent.target == _fileReferenceList)
				_files = _fileReferenceList.fileList;
			else
				_files = [_singlefileReference];

			for each(var file:FileReference in _files)
			{
				var fileVO:FileVO = new FileVO();
				fileVO.file = new PolledFileReference(file);
				fileVO.title = file.name;
				var nameSplitted:Array = file.name.split(".");
				fileVO.extension = nameSplitted[nameSplitted.length-1];
				fileVO.mediaTypeCode = model.activeFileFilterVO.mediaType;
				fileVO.entryType = model.activeFileFilterVO.entryType;

				files.push(fileVO);
			}
			model.files = model.files.concat(files);

			var validateLimitationsCommand:ValidateLimitationsCommand = new ValidateLimitationsCommand();
			validateLimitationsCommand.execute();

			var notifyShell:NotifyShellCommand = new NotifyShellCommand(KUploadEvent.SELECT);
			notifyShell.execute()
		}
	}
}