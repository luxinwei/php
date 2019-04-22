package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import java.math.BigInteger;

/**
 * 定时任务
 * Created by wangyuan on 2018/1/7
 */
public class SchedulerJobVO extends BaseEntity {

    private static final long serialVersionUID = 3304210257939684569L;

    @NotBlank(message = "定时任务名称不能为空")
    @Length(message = "定时器名称长度应为1-50字符", min = 1, max = 50)
    private String jobName;

    /** 扩展字段，暂留 */
    @DictionaryCodeValidate(message = "定时任务类别不合规范",dictionaryData = "patrolTaskJob,trainingDutyJob,practiceTaskJob")
    private String quartzType;

    private String quartzTypeName;

    @NotBlank(message = "定时任务时间表达式不能为空")
    @Length(message = "定时任务试剂表达式长度应为1-50字符",min = 1,max = 50)
    private String cronExpression;

    /** 定时任务所属应用编码 */
    private String appCode;

    /** 定时任务所属部门 */
    private Long depId;

    /** 定时任务状态 1：可用  0：不可用*/
    private Integer state;

    /** 定时任务描述 */
    private String description;

    public String getJobName() {
        return jobName;
    }

    public void setJobName(String jobName) {
        this.jobName = jobName;
    }

    public String getQuartzType() {
        return quartzType;
    }

    public void setQuartzType(String quartzType) {
        this.quartzType = quartzType;
    }

    public String getCronExpression() {
        return cronExpression;
    }

    public void setCronExpression(String cronExpression) {
        this.cronExpression = cronExpression;
    }

    public String getAppCode() {
        return appCode;
    }

    public void setAppCode(String appCode) {
        this.appCode = appCode;
    }

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public Integer getState() {
        return state;
    }

    public void setState(Integer state) {
        this.state = state;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getQuartzTypeName() {
        return quartzTypeName;
    }

    public void setQuartzTypeName(String quartzTypeName) {
        this.quartzTypeName = quartzTypeName;
    }
}
