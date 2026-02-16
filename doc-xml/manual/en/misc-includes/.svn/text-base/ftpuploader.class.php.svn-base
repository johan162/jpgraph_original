<?php
/**
* Class FTPUploader
*/
class FTPUploader {
    private $iserver='', $iuid='',$ipwd='';
    /**
     * Creat new instance of the FTP uploader class
     * 
     * @param $aServer The URI for the server
     * @param $aUID The ftp user id
     * @param $aPWD The ftp user password
     * @return FTPUploader
     */
    function __construct($aServer,$aUID,$aPWD) {
        $this->iserver = $aServer;
        $this->iuid = $aUID;
        $this->ipwd = $aPWD;   
    }
    /**
     * Upload the specified file to the given directory on the server
     * 
     * @param $aFile Name and path of file to uploads
     * @param $aUploadDir The directory on the server where the file should be stored
     */
    function Upload($aFile,$aUploadDir) {
        $conn_id = @ftp_connect($this->iserver);
        
        if ( !$conn_id ) {
            JpGraphError::Raise("FTP connection failed.\nAttempted to connect to {$this->iserver} for user {$this->iuid}.");
        }

        $login_result = ftp_login($conn_id, $this->iuid, $this->ipwd);
        if ((!$conn_id) || (!$login_result)) {
            JpGraphError::Raise("FTP login has failed.\nAttempted to connect to {$this->iserver} for user {$this->iuid}.",3);
        }
                 
        syslog(LOG_INFO,JpGraphError::GetTitle()."Connected to {$this->iserver}");
        
        // Delete potential old file
        $ftp_file = $aUploadDir.basename($aFile);
        $res = @ftp_delete($conn_id,$ftp_file);
        
        // Upload new image
        $upload = ftp_put($conn_id, $ftp_file, $aFile, FTP_BINARY);
        if (!$upload) {
            JpGraphError::Raise("FTP upload of image failed.");
        }
         		
        syslog(LOG_INFO,JpGraphError::GetTitle()."Succesfully uploaded $aFile to {$this->iserver}.");
        
        @ftp_close($conn_id);        
    } 
}  
?>
