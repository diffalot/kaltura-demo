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
	import com.kaltura.upload.events.KUploadErrorEvent;
	import com.kaltura.upload.vo.FileVO;
	import com.kaltura.vo.importees.UploadStatusTypes;

	public class ValidateUploadCommand extends BaseUploadCommand
	{
		override public function execute():void
		{
			var uploadErrorIndices:Array = [];
			for (var i:int = 0; i < model.files.length; i++)
			{
				var fileVo:FileVO = model.files[i];
				if (fileVo.uploadStatus == UploadStatusTypes.UPLOAD_FAILED)
				{
					uploadErrorIndices.push(i);
				}
			}
			var anyUploadErrors:Boolean = uploadErrorIndices.length > 0;

			if (anyUploadErrors)
			{
				model.error = KUploadErrorEvent.UPLOAD_ERROR;
				model.uploadedErrorIndices = uploadErrorIndices;
			}
			else
			{
				model.error = null;
				model.uploadedErrorIndices = [];

			}
		}
	}
}