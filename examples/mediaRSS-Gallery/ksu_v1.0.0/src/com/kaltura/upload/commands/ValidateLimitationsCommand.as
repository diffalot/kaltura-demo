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

	public class ValidateLimitationsCommand extends BaseUploadCommand
	{
		override public function execute():void
		{
			if (fileSizeExceeds())
			{
				model.error = KUploadErrorEvent.FILE_SIZE_EXCEEDS;
				return;
			}
			else if (totalSizeExceeds())
			{
				model.error = KUploadErrorEvent.TOTAL_SIZE_EXCEEDS;
				return;
			}
			else if (numFilesExceeds())
			{
				model.error = KUploadErrorEvent.NUM_FILES_EXCEEDS;
				return;
			}
			model.error = null;
		}

		private function fileSizeExceeds():Boolean
		{
			var files:Array = model.files;
			var exceedingFiles:Array = [];
			files.forEach(
				function(fileVo:FileVO, i:int, list:Array):void
				{
					if (fileVo.bytesTotal > model.maxFileSize * 1e6)
						exceedingFiles.push(i);
				}
			);
			model.exceedingFilesIndices = exceedingFiles;
			return exceedingFiles.length > 0;
		}

		private function totalSizeExceeds():Boolean
		{
			return model.totalSize > model.maxTotalSize * 1e6;
		}

		private function numFilesExceeds():Boolean
		{
			return model.files.length > model.maxUploads;
		}

	}
}