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
package com.kaltura.upload.vo
{
	import com.kaltura.net.PolledFileReference;
	import com.kaltura.vo.importees.UploadStatusTypes;

	import flash.events.Event;
	import flash.events.ProgressEvent;

	public class FileVO
	{
		private static var uniquenessCounter:int;

		public function FileVO():void
		{
			uniquenessCounter++;
			guid = new Date().time.toString() + uniquenessCounter.toString();
		}
		public var bytesLoaded:uint;
		public var bytesTotal:uint
    public var description:String
		public var title:String
		public var tags:Array = [];
		public var guid:String;
		public var extension:String;
		public var mediaTypeCode:String;
		public var entryType:String;
		public var entryId:String;
		public var uploadStatus:String = UploadStatusTypes.NOT_UPLOADED;

		public function set file(value:PolledFileReference):void
		{
			removeFileListeners();

			_file = value;
			bytesTotal = _file.fileReference.size;

			addFileListeners();
		}
		public function get file():PolledFileReference
		{
			return _file;
		}
		private var _file:PolledFileReference;


		private function addFileListeners():void
		{
			_file.addEventListener(ProgressEvent.PROGRESS, 		fileProgressHandler);
			_file.addEventListener(Event.CANCEL, 				fileCancelHandler);
			_file.addEventListener(Event.COMPLETE, 				fileCompleteHandler);
		}

		private function removeFileListeners():void
		{
			if (!_file) return;
			_file.removeEventListener(ProgressEvent.PROGRESS, 	fileProgressHandler);
			_file.removeEventListener(Event.CANCEL, 			fileCancelHandler);
		}

		private function fileProgressHandler(progressEvent:ProgressEvent):void
		{
			bytesLoaded = progressEvent.bytesLoaded;
		}

		private function fileCancelHandler(cancelEvent:Event):void
		{
			bytesLoaded = 0;
		}

		private function fileCompleteHandler(completeEvent:Event):void
		{
			bytesLoaded = bytesTotal;
		}
	}
}
