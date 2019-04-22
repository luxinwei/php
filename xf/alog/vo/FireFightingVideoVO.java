package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseFields;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

public class FireFightingVideoVO extends BaseFields{

    private static final long serialVersionUID = -8295765096194306157L;

    /** 视频名称  name **/
    @NotBlank(message = "视频名称不能为空")
    @Length(message = "视频名称长度应为1-50字符", min = 1, max = 50)
    private String name;

    /** 视频描述  description **/
    @Length(message = "视频描述长度应为1-200字符", min = 1, max = 200)
    private String description;

    /** 关联附件id  file_id **/
    @NotBlank(message = "视频附件不能为空")
    private String file;

    @NotBlank(message = "视频附件名称不能为空")
    private String fileName;

    /** 上传人  upload_user **/
    private String uploadUser;

    /**   视频名称  name   **/
    public String getName() {
        return name;
    }

    /**   视频名称  name   **/
    public void setName(String name) {
        this.name = name == null ? null : name.trim();
    }

    /**   视频描述  description   **/
    public String getDescription() {
        return description;
    }

    /**   视频描述  description   **/
    public void setDescription(String description) {
        this.description = description == null ? null : description.trim();
    }

    public String getFile() {
        return file;
    }

    public void setFile(String file) {
        this.file = file;
    }

    /**   上传人  upload_user   **/
    public String getUploadUser() {
        return uploadUser;
    }

    /**   上传人  upload_user   **/
    public void setUploadUser(String uploadUser) {
        this.uploadUser = uploadUser == null ? null : uploadUser.trim();
    }

    public String getFileName() {
        return fileName;
    }

    public void setFileName(String fileName) {
        this.fileName = fileName;
    }
}