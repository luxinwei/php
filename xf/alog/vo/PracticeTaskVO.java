package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import java.util.Date;

/**
 * 演练任务管理
 * Created by wangyuan on 2018/1/7
 */
public class PracticeTaskVO extends BaseEntity {

    private static final long serialVersionUID = -6741479806520380749L;

    /** 下发单位id   业主用户版，新增页面不显示该字段*/
    private Long depId;

    /**下发单位名称 */
    private String depName;

    /** 业主用户版，新增页面不显示该字段 */
    /** 管理平台中， 该字段显示并必填 */
    private Long executeDepId;

    @NotBlank(message = "演练任务不能为空")
    @Length(message = "演练任务长度应为1-1000字符", min = 1, max = 1000)
    private String practiceContent;

    @NotBlank(message = "演练任务名称不能为空")
    @Length(message = "演练任务名称长度应为1-50字符", min = 1, max = 50)
    private String name;

    @NotNull(message = "演练任务开始时间不能为空")
    private Date beginTime;

    @NotNull(message = "演练任务结束时间不能为空")
    private Date endTime;

    @NotBlank(message = "演练任务要求不能为空")
    @Length(message = " 演练任务要求长度应为1-500字符",min = 1, max = 500)
    private String practiceRequirements;

    @NotBlank(message = "演练状态不能为空")
    @DictionaryCodeValidate(message = "演练状态不符合规范", dictionaryData = "0,1,2")
    private String taskStateCode;

    private String taskStateName;

    /** 是否超时 ，系统内部根据时间自己判断*/
    private Integer overtimeFlag;

    /** 演练结果 1:已完成  0:未完成 */
    private Integer result;

    /** 资料照片，视频等 */
    private String [] files;

    /** 文件名称，必须跟file一一对应 */
    private String [] filesName;
    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public Long getExecuteDepId() {
        return executeDepId;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setExecuteDepId(Long executeDepId) {
        this.executeDepId = executeDepId;
    }

    public String getPracticeContent() {
        return practiceContent;
    }

    public void setPracticeContent(String practiceContent) {
        this.practiceContent = practiceContent;
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

    public String getPracticeRequirements() {
        return practiceRequirements;
    }

    public void setPracticeRequirements(String practiceRequirements) {
        this.practiceRequirements = practiceRequirements;
    }

    public Integer getOvertimeFlag() {
        return overtimeFlag;
    }

    public void setOvertimeFlag(Integer overtimeFlag) {
        this.overtimeFlag = overtimeFlag;
    }

    public Integer getResult() {
        return result;
    }

    public void setResult(Integer result) {
        this.result = result;
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

    public String getDepName() {
        return depName;
    }

    public void setDepName(String depName) {
        this.depName = depName;
    }

    public String getTaskStateCode() {
        return taskStateCode;
    }

    public void setTaskStateCode(String taskStateCode) {
        this.taskStateCode = taskStateCode;
    }

    public String getTaskStateName() {
        return taskStateName;
    }

    public void setTaskStateName(String taskStateName) {
        this.taskStateName = taskStateName;
    }
}
