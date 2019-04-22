package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.math.BigInteger;
import java.util.Date;

/**
 * Created by wangyuan on 2018/1/10
 */
public class FireAlarmAcceptVO extends BaseEntity {

    private static final long serialVersionUID = -7937699958824893182L;

    /** 所属业主单位 */
    @NotNull(message = "所属业主单位不能为空")
    private Long depId;

    /*单位名称*/
    private String depName;

    /** 首次报警时间 */
    @NotNull(message = "首次报警时间不能为空")
    @Past(message = "首次报警时间异常")
    private Date firstAlarmTime;

    /** 受理时间 */
    private Date acceptTime;

    /** 受理结束时间 */
    private Date acceptEndTime;

    /** 信息类型  字典项*/
    @DictionaryCodeValidate(message = "信息类型不符合规范", dictionaryData = "1,2,9")
    private String acceptedTypeCode;

    private String acceptedTypeName;

    /** 信息描述 */
    private String description;

    /** 处理结果 */
    private String handleResult;

    /** 受理人员姓名 */
    private String acceptUser;

    /** 用户联系人姓名 */
    private String userName;

    /** 消息确认 字典项 */
    @DictionaryCodeValidate(message = "消息确认不符合规范", dictionaryData = "1,2,9")
    private String acceptedConfirmCode;

    private String acceptedConfirmName;

    /** 向消防通信指挥中心报告时间 */
    private Date reportTime;

    /** 消防通信指挥中心反馈确认时间 */
    private Date reportFeebackTime;

    /** 消防通信指挥中心受理员姓名 */
    private String monitorUserName;

    /** 消防通信指挥中心接警处理情况 */
    private String monitorHandleInfo;

    /*处理状态（0：未处理，1：已处理）*/
    private String handleState;

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public Date getFirstAlarmTime() {
        return firstAlarmTime;
    }

    public void setFirstAlarmTime(Date firstAlarmTime) {
        this.firstAlarmTime = firstAlarmTime;
    }

    public Date getAcceptTime() {
        return acceptTime;
    }

    public void setAcceptTime(Date acceptTime) {
        this.acceptTime = acceptTime;
    }

    public Date getAcceptEndTime() {
        return acceptEndTime;
    }

    public void setAcceptEndTime(Date acceptEndTime) {
        this.acceptEndTime = acceptEndTime;
    }

    public String getAcceptedTypeCode() {
        return acceptedTypeCode;
    }

    public void setAcceptedTypeCode(String acceptedTypeCode) {
        this.acceptedTypeCode = acceptedTypeCode;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getHandleResult() {
        return handleResult;
    }

    public void setHandleResult(String handleResult) {
        this.handleResult = handleResult;
    }

    public String getAcceptUser() {
        return acceptUser;
    }

    public void setAcceptUser(String acceptUser) {
        this.acceptUser = acceptUser;
    }

    public String getUserName() {
        return userName;
    }

    public void setUserName(String userName) {
        this.userName = userName;
    }

    public String getAcceptedConfirmCode() {
        return acceptedConfirmCode;
    }

    public void setAcceptedConfirmCode(String acceptedConfirmCode) {
        this.acceptedConfirmCode = acceptedConfirmCode;
    }

    public Date getReportTime() {
        return reportTime;
    }

    public void setReportTime(Date reportTime) {
        this.reportTime = reportTime;
    }

    public Date getReportFeebackTime() {
        return reportFeebackTime;
    }

    public void setReportFeebackTime(Date reportFeebackTime) {
        this.reportFeebackTime = reportFeebackTime;
    }

    public String getMonitorUserName() {
        return monitorUserName;
    }

    public void setMonitorUserName(String monitorUserName) {
        this.monitorUserName = monitorUserName;
    }

    public String getMonitorHandleInfo() {
        return monitorHandleInfo;
    }

    public void setMonitorHandleInfo(String monitorHandleInfo) {
        this.monitorHandleInfo = monitorHandleInfo;
    }

    public String getAcceptedTypeName() {
        return acceptedTypeName;
    }

    public void setAcceptedTypeName(String acceptedTypeName) {
        this.acceptedTypeName = acceptedTypeName;
    }

    public String getAcceptedConfirmName() {
        return acceptedConfirmName;
    }

    public void setAcceptedConfirmName(String acceptedConfirmName) {
        this.acceptedConfirmName = acceptedConfirmName;
    }

    public String getDepName() {
        return depName;
    }

    public void setDepName(String depName) {
        this.depName = depName;
    }
}
