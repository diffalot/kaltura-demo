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
package com.kaltura.upload.events
{
	import flash.events.Event;

	public class KUploadErrorEvent extends Event
	{
		public static const KS_ERRORS:String = "ksErrors";
		public static const UPLOAD_ERROR:String = "uploadError";
		public static const ADD_ENTRY_FAILED:String = "addEntryFailed";
		public static const UI_CONF_ERROR:String = "uiConfError";


		public static const FILE_SIZE_EXCEEDS:String 	= "fileSizeExceeds";
		public static const TOTAL_SIZE_EXCEEDS:String 	= "totalSizeExceeds";
		public static const NUM_FILES_EXCEEDS:String 	= "numFilesExceeds";

		public function KUploadErrorEvent(type:String, bubbles:Boolean = false, cancelable:Boolean = false)
		{
			super(type, bubbles, cancelable);
		}
	}
}