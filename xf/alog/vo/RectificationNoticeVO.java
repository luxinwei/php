package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Future;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.math.BigInteger;
import java.util.Date;

/**
 * 整改通知VO
 */
public class RectificationNoticeVO extends BaseEntity {

    private static final long serialVersionUID = -1399982583694873266L;

    @NotBlank(message = "整改通知编号不能为空")
    @Length(message = "整改通知编号应为1-50字符", min = 1, max = 50)
    private String code;

    /** 下发单位 */
    private Long monitorCenterId;

    /** 下发单位 */
    private String sentDepName;

    @NotNull(message = "整改单位不能为空")
    private Long depId;

    /** 下发单位appCode */
    private String appCode;

    /** 执行单位 */
    private String depName;

    @NotNull(message = "检查时间不能为空")
    @Past(message = "检查时间异常")
    private Date checkTime;

    @NotBlank(message = "违规内容不能为空")
    @Length(message = "违规内容长度应为1-500字符", min = 1 ,max = 500)
    private String illegalContent;

    @NotNull(message = "整改期限不能为空")
    private Integer rectificationDeadline;

    /** 整改状态 */
    @NotNull(message = "整改状态不能为空")
    @DictionaryCodeValidate(message = "整改状态不符合规范", dictionaryData = "0,1,2,3")
    private String rectificationStateCode;

    private String rectificationStateName;

    /**  相关文件附件 */
    private String file;

    /** 文件名称 */
    private String fileName;

    public String getCode() {
        return code;
    }

    public void setCode(String code) {
        this.code = code;
    }

    public Long getMonitorCenterId() {
        return monitorCenterId;
    }

    public void setMonitorCenterId(Long monitorCenterId) {
        this.monitorCenterId = monitorCenterId;
    }

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public Date getCheckTime() {
        return checkTime;
    }

    public void setCheckTime(Date checkTime) {
        this.checkTime = checkTime;
    }

    public String getIllegalContent() {
        return illegalContent;
    }

    public void setIllegalContent(String illegalContent) {
        this.illegalContent = illegalContent;
    }

    public Integer getRectificationDeadline() {
        return rectificationDeadline;
    }

    public void setRectificationDeadline(Integer rectificationDeadline) {
        this.rectificationDeadline = rectificationDeadline;
    }

    public String getRectificationStateCode() {
        return rectificationStateCode;
    }

    public void setRectificationStateCode(String rectificationStateCode) {
        this.rectificationStateCode = rectificationStateCode;
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

    public String getRectificationStateName() {
        return rectificationStateName;
    }

    public void setRectificationStateName(String rectificationStateName) {
        this.rectificationStateName = rectificationStateName;
    }

    public String getAppCode() {
        return appCode;
    }

    public void setAppCode(String appCode) {
        this.appCode = appCode;
    }

    public String getSentDepName() {
        return sentDepName;
    }

    public void setSentDepName(String sentDepName) {
        this.sentDepName = sentDepName;
    }

    public String getDepName() {
        return depName;
    }

    public void setDepName(String depName) {
        this.depName = depName;
    }
}
