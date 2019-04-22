package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.math.BigInteger;
import java.util.Date;

/**
 * 培训任务管理
 * Created by zhang on 2018/1/8
 */
public class TrainingDutyVO extends BaseEntity {

    private static final long serialVersionUID = -3512369407479441530L;

    /** 默认登录人所属部门 */
    private Long depId;

    /** 管理平台显示该字段，不能为空 */
    /** 业主用户版平台不显示该字段 */
    private Long executeDepId;

    @NotBlank(message = "培训标题不能为空")
    @Length(message = "培训标题长度应为1-100字符",min = 1,max = 100)
    private String trainingTitle;

    @NotBlank(message = "培训内容不能为空")
    @Length(message = "培训内容长度应为1-2000字符",min = 1,max = 2000)
    private String trainingContent;

    @NotNull(message = "培训开始时间不能为空")
    private Date beginTime;

    @NotNull(message = "培训结束时间不能为空")
    private Date endTime;

    /** 培训任务状态 */
    @DictionaryCodeValidate(message = "培训任务状态不符合规范", dictionaryData = "0,1,2")
    private String taskStateCode;

    private String taskStateName;

    /** 是否超时，1:是  0:否 */
    private Integer overtimeFlag;

    @Length(message = "参加率长度应为1-10字符",min = 1,max = 10)
    private String joiningRate;

    @Length(message = "合格率长度应为1-10字符",min = 1,max = 10)
    private String percentRate;

    /** 培训相关图片，base64 */
    private String[] files;

    /** 文件名称，必须跟file一一对应 */
    private String[] filesName;

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public Long getExecuteDepId() {
        return executeDepId;
    }

    public void setExecuteDepId(Long executeDepId) {
        this.executeDepId = executeDepId;
    }

    public String getTrainingTitle() {
        return trainingTitle;
    }

    public void setTrainingTitle(String trainingTitle) {
        this.trainingTitle = trainingTitle;
    }

    public String getTrainingContent() {
        return trainingContent;
    }

    public void setTrainingContent(String trainingContent) {
        this.trainingContent = trainingContent;
    }

    public Date getBeginTime() {
        return beginTime;
    }

    public void setBeginTime(Date beginTime) {
        this.beginTime = beginTime;
    }

    public Date getEndTime() {
        return endTime;
    }

    public void setEndTime(Date endTime) {
        this.endTime = endTime;
    }

    public String getTaskStateCode() {
        return taskStateCode;
    }

    public void setTaskStateCode(String taskStateCode) {
        this.taskStateCode = taskStateCode;
    }

    public Integer getOvertimeFlag() {
        return overtimeFlag;
    }

    public void setOvertimeFlag(Integer overtimeFlag) {
        this.overtimeFlag = overtimeFlag;
    }

    public String getJoiningRate() {
        return joiningRate;
    }

    public void setJoiningRate(String joiningRate) {
        this.joiningRate = joiningRate;
    }

    public String getPercentRate() {
        return percentRate;
    }

    public void setPercentRate(String percentRate) {
        this.percentRate = percentRate;
    }

    public String[] getFiles() {
        return files;
    }

    public void setFiles(String[] files) {
        this.files = files;
    }

    public String[] getFilesName() {
        return filesName;
    }

    public void setFilesName(String[] filesName) {
        this.filesName = filesName;
    }

    public String getTaskStateName() {
        return taskStateName;
    }

    public void setTaskStateName(String taskStateName) {
        this.taskStateName = taskStateName;
    }
}
