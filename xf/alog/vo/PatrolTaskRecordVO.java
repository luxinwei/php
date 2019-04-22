package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.util.Date;

/**
 * 巡查任务记录
 */
public class PatrolTaskRecordVO extends BaseEntity {

    private static final long serialVersionUID = -3365400411088816738L;

    @NotNull(message = "巡查任务id不能为空")
    private Long taskId;

    /** 巡查任务名称 */
    private String taskName;

    /** 下发单位名称 */
    private String depName;

    /** 偏差时间 */
    private Integer deviationTime;

    /** 巡查人姓名 */
    private String patrolUserName;

    /** 执行单位名称 */
    private String executeDepName;

    @Past(message = "巡查任务开始时间不合法")
    private Date beginTime;

    @Past(message = "巡查任务结束时间不能为空")
    private Date endTime;

    @NotNull(message = "巡查任务个数不能为空")
    private Integer pointCount;

    @NotNull(message = "已巡查点个数不能为空")
    private Integer patrolledCount;

    @NotNull(message = "是否超期不能为空")
    private Integer overtimeFlag;

    @Past(message = "入库时间不能为空")
    private Date createTime;

    public String getTaskName() {
        return taskName;
    }

    public void setTaskName(String taskName) {
        this.taskName = taskName;
    }

    public String getDepName() {
        return depName;
    }

    public void setDepName(String depName) {
        this.depName = depName;
    }

    public Integer getDeviationTime() {
        return deviationTime;
    }

    public void setDeviationTime(Integer deviationTime) {
        this.deviationTime = deviationTime;
    }

    public String getPatrolUserName() {
        return patrolUserName;
    }

    public void setPatrolUserName(String patrolUserName) {
        this.patrolUserName = patrolUserName;
    }

    public String getExecuteDepName() {
        return executeDepName;
    }

    public void setExecuteDepName(String executeDepName) {
        this.executeDepName = executeDepName;
    }

    public Long getTaskId() {
        return taskId;
    }

    public void setTaskId(Long taskId) {
        this.taskId = taskId;
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

    public Integer getPointCount() {
        return pointCount;
    }

    public void setPointCount(Integer pointCount) {
        this.pointCount = pointCount;
    }

    public Integer getPatrolledCount() {
        return patrolledCount;
    }

    public void setPatrolledCount(Integer patrolledCount) {
        this.patrolledCount = patrolledCount;
    }

    public Integer getOvertimeFlag() {
        return overtimeFlag;
    }

    public void setOvertimeFlag(Integer overtimeFlag) {
        this.overtimeFlag = overtimeFlag;
    }

    public Date getCreateTime() {
        return createTime;
    }

    public void setCreateTime(Date createTime) {
        this.createTime = createTime;
    }
}
