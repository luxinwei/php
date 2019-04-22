package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Digits;
import javax.validation.constraints.Max;
import javax.validation.constraints.NotNull;

public class PatrolTaskVO extends BaseEntity {

    private static final long serialVersionUID = -7013921269871838958L;

//    @NotNull(message = "下发单位id不能为空")
    private Long depId;

    //下发单位名称
    private String depName;

    @NotBlank(message = "巡查任务名称不能为空")
    @Length(message = "巡查任务名称的长度应为50字节", min = 1, max = 50)
    private String name;

    @NotBlank(message = "巡查类别不能为空")
    @DictionaryCodeValidate(message = "巡查类别不合法", dictionaryData = "1,2,3,9")
    private String patrolTypeCode;

    @NotNull(message = "执行单位id不能空")
    private Long executeDepId;

    private String executeDepName;

    @NotBlank(message = "巡查策略不能为空")
    @Length(message = "巡查策略的长度应为50字节", min = 1, max = 50)
    private String strategy;

    @NotNull(message = "巡查人员id不能为空")
    private Long patrolUser;

    /** 巡查人员姓名 */
    private String patrolUserName;

    /** 偏差时间，单位小时 */
    @Max(message = "最大偏差时间为2小时",value = 2)
    @NotNull(message = "偏差时间不能为空")
    @Digits(integer = 2, fraction = 0)
    private Integer deviationTime;

    @NotBlank(message = "巡查点不能为空")
    private String patrolPoints;

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public Long getExecuteDepId() {
        return executeDepId;
    }

    public void setExecuteDepId(Long executeDepId) {
        this.executeDepId = executeDepId;
    }

    public String getStrategy() {
        return strategy;
    }

    public void setStrategy(String strategy) {
        this.strategy = strategy;
    }

    public Long getPatrolUser() {
        return patrolUser;
    }

    public void setPatrolUser(Long patrolUser) {
        this.patrolUser = patrolUser;
    }

    public String getPatrolTypeCode() {
        return patrolTypeCode;
    }

    public void setPatrolTypeCode(String patrolTypeCode) {
        this.patrolTypeCode = patrolTypeCode;
    }

    public Integer getDeviationTime() {
        return deviationTime;
    }

    public void setDeviationTime(Integer deviationTime) {
        this.deviationTime = deviationTime;
    }

    public String getPatrolPoints() {
        return patrolPoints;
    }

    public void setPatrolPoints(String patrolPoints) {
        this.patrolPoints = patrolPoints;
    }

    public String getDepName() {
        return depName;
    }

    public void setDepName(String depName) {
        this.depName = depName;
    }

    public String getExecuteDepName() {
        return executeDepName;
    }

    public void setExecuteDepName(String executeDepName) {
        this.executeDepName = executeDepName;
    }

    public String getPatrolUserName() {
        return patrolUserName;
    }

    public void setPatrolUserName(String patrolUserName) {
        this.patrolUserName = patrolUserName;
    }
}
