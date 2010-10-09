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
package com.kaltura.upload.model
{
	import com.kaltura.upload.vo.FileFilterVO;
	import com.kaltura.upload.vo.FileVO;

	import flash.utils.Dictionary;

	public class KUploadModelLocator
	{
		//Singleton implementation
		//---------------------------------
		include "SingletonImpl.as"
		//---------------------------------

		//Basic parameters
		public var ks:String;
		public var uid:String;
		public var uiConfId:String;
		public var partnerId:String;
		public var subPId:String;
		public var host:String = "http://www.kaltura.com";

		//uplaoder specific
		public var permissions:String;
		public var groupId:String;
		public var screenName:String;
		public var siteUrl:String;

		public var quickEdit:Boolean = true;
		public var partnerData:String;
		public var uploadUrl:String;
		public var addEntryUrl:String;
		public var entryId:String = "-1";
		public var fileFilterVoList:Dictionary; /*of FileFilterVO, key: file filter id*/
		public var activeFileFilterVO:FileFilterVO;
		public var jsDelegate:String;

		public var baseRequestData:Object;

		public var state:String;


		public var maxFileSize:Number;
		public var maxTotalSize:Number;
		public var maxUploads:uint;

		public var conversionProfile:String;

		public var files:Array = []; /*of FileVO*/

		public var currentlyUploadedFileVo:FileVO;

		public function get totalSize():uint
		{
			var totalKb:uint;

			files.forEach
			(
				function(fileVo:FileVO, i:int, ar:Array):void
				{
					totalKb += fileVo.file.fileReference.size;
				}
			);
			return totalKb;
		}

		public var uploadedErrorIndices:Array;

		public var error:String;
		public var exceedingFilesIndices:Array;


	}
}