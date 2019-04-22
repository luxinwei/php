package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.math.BigInteger;
import java.util.Date;

/**
 * 检测管理
 * Created by zhang on 2018/1/7
 */
public class TestManagementVO extends BaseEntity {

    private static final long serialVersionUID = 5311302623751036859L;

    @NotNull(message = "关联设施id不能为空")
    private Long deviceId;

    @NotBlank(message = "检测名称不能为空")
    @Length(message = "检测名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    @NotBlank(message = "检测单位不能为空")
    @Length(message = "检测单位长度应为1-100字符",min = 1,max = 100)
    private String department;

    @Length(message = "检测周期长度应为1-50字符",min = 1,max = 50)
    private String period;

    @NotNull(message = "检测时间不能为空")
    private Date testTime;

    @NotBlank(message = "检测负责人不能为空")
    @Length(message = "检测负责人长度应为1-50字符",min = 1,max = 50)
    private String director;

    @NotBlank(message = "检测结果不能为空")
    @Length(message = "检测结果长度应为1-100字符",min = 1,max = 100)
    private String result;

    /** 检测相关文件上传 */
    private String file;

    /** 文件名称 */
    private String fileName;

    private String deviceName;//设施名称

    public Long getDeviceId() {
        return deviceId;
    }

    public void setDeviceId(Long deviceId) {
        this.deviceId = deviceId;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDepartment() {
        return department;
    }

    public void setDepartment(String department) {
        this.department = department;
    }

    public String getPeriod() {
        return period;
    }

    public void setPeriod(String period) {
        this.period = period;
    }

    public Date getTestTime() {
        return testTime;
    }

    public void setTestTime(Date testTime) {
        this.testTime = testTime;
    }

    public String getDirector() {
        return director;
    }

    public void setDirector(String director) {
        this.director = director;
    }

    public String getResult() {
        return result;
    }

    public void setResult(String result) {
        this.result = result;
    }

    public String getFile() {
        return file;
    }

    public void setFile(String file) {
        this.file = file;
    }

    public String getFileName() {
        return fileName;
    }

    public void setFileName(String fileName) {
        this.fileName = fileName;
    }

    public String getDeviceName() {
        return deviceName;
    }

    public void setDeviceName(String deviceName) {
        this.deviceName = deviceName;
    }
}
