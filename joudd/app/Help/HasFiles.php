<?php

namespace App\Help;
trait HasFiles{
        /**
     * Attachment Dir name
     */
    /**
     * Attachments
     */
    public function getAttachments(){
        return Setting::getmodelAttachments($this,$this->dirName);
    }

    // this method using for  course media using  dirName => course_media
    public function getMediaAttachments(){
        return Setting::getmodelAttachments($this,$this->dirName);
    }
    /**
     * store attachments.
     */
    public function setAttachments($files){
        return Setting::storeModelAttachments($files, $this,$this->dirName);
    }
    /**
     * delete all attachments.
     */
    public function destroyAttachments(){
        return Setting::destroyAttachments($this,$this->dirName);
    }
     /**
     * delete attachment By it's url.
     *
     */
    public function deleteAttachmentByUrl($url){
        return Setting::deleteAttachmentByUrl($url,$this,$this->dirName);
    }
// delete course media by id
    public function deleteMediaAttachmentByUrl($url){
        return Setting::deleteAttachmentByUrl($url,$this,"course_media");
    }
    // delete course media
    public function destroyMediaAttachments(){
        return Setting::destroyAttachments($this,"course_media");
    }
}

?>
