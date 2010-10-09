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
package com.kaltura.net
{
	import flash.events.Event;
	import flash.events.EventDispatcher;
	import flash.net.FileReferenceList;

	[Event(name="cancel", type="flash.events.Event")]
	[Event(name="select", type="flash.events.Event")]
	public class KFileReferenceList extends EventDispatcher
	{
		private var _fileReferenceList:FileReferenceList;
		private var _fileList:Array;

		public function KFileReferenceList()
		{
			_fileReferenceList = new FileReferenceList();
			_fileReferenceList.addEventListener(Event.SELECT, fileReferenceListSelectHandler);
		}

		public function get fileList():Array /*of FileReference*/
		{
			return _fileList;
		}

		public function browse(typeFilter:Array = null, singleFile:Boolean = false):Boolean
		{
			_fileReferenceList.browse(typeFilter);
		}

		private function fileReferenceListSelectHandler(selectEvent:Event):void
		{
			_fileList = _fileReferenceList.fileList;
			dispatchEvent(new Event(Event.SELECT));
		}
	}
}