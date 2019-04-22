package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Digits;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.math.BigDecimal;
import java.util.Date;

/**
 * 火灾信息管理
 * Created by wangyuan on 2018/1/6
 */
public class FireInfoManagementVO extends BaseEntity {

    private static final long serialVersionUID = 113938918094673798L;

    @NotNull(message = "所属单位id不能为空")
    private Long depId;

    @NotBlank(message = "起火位置不能为空")
    @Length(message = "起火位置长度应为1-100字符", min = 1, max = 100)
    private String firePosition;

    @Past(message = "起火时间不合法")
    @NotNull(message = "起火时间不能为空")
    private Date fireTime;

    @Length(message = "起火原因长度应为1-100字符", min = 1, max = 100)
    private String fireReason;

    @NotBlank(message = "报警方式不能为空")
    @DictionaryCodeValidate(message = "报警方式不符合规范",dictionaryData = "1,2,3")
    private String alarmTypeCode;

    private String alarmTypeName;

    @Digits(message = "过火面积不符合要求",integer = 8, fraction = 2)
    private BigDecimal burnedArea;

    @Digits(message = "死亡人数不符合要求",integer = 3, fraction = 0)
    private Integer deathCount;

    @Digits(message = "受伤人数不符合要求",integer = 3, fraction = 0)
    private Integer woundCount;

    @Digits(message = "财产损失不符合要求", integer = 8, fraction = 2)
    private BigDecimal propertyLoss;

    @Length(message = "火灾扑救描述长度应为1-500字符", min = 1, max = 500)
    private String fireFightingDes;

    @DictionaryCodeValidate(message = "状态不符合规范",dictionaryData = "0,1,2,3,4")
    private String dataStateCode;

    private String dataStateName;

    /** 相关附件 */
    private String file;

    /** 文件名称 */
    private String fileName;

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public String getFirePosition() {
        return firePosition;
    }

    public void setFirePosition(String firePosition) {
        this.firePosition = firePosition;
    }

    public Date getFireTime() {
        return fireTime;
    }

    public void setFireTime(Date fireTime) {
        this.fireTime = fireTime;
    }

    public String getFireReason() {
        return fireReason;
    }

    public void setFireReason(String fireReason) {
        this.fireReason = fireReason;
    }

    public String getAlarmTypeCode() {
        return alarmTypeCode;
    }

    public void setAlarmTypeCode(String alarmTypeCode) {
        this.alarmTypeCode = alarmTypeCode;
    }

    public BigDecimal getBurnedArea() {
        return burnedArea;
    }

    public void setBurnedArea(BigDecimal burnedArea) {
        this.burnedArea = burnedArea;
    }

    public Integer getDeathCount() {
        return deathCount;
    }

    public void setDeathCount(Integer deathCount) {
        this.deathCount = deathCount;
    }

    public Integer getWoundCount() {
        return woundCount;
    }

    public void setWoundCount(Integer woundCount) {
        this.woundCount = woundCount;
    }

    public BigDecimal getPropertyLoss() {
        return propertyLoss;
    }

    public void setPropertyLoss(BigDecimal propertyLoss) {
        this.propertyLoss = propertyLoss;
    }

    public String getFireFightingDes() {
        return fireFightingDes;
    }

    public void setFireFightingDes(String fireFightingDes) {
        this.fireFightingDes = fireFightingDes;
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

    public String getAlarmTypeName() {
        return alarmTypeName;
    }

    public void setAlarmTypeName(String alarmTypeName) {
        this.alarmTypeName = alarmTypeName;
    }

    public String getDataStateCode() {
        return dataStateCode;
    }

    public void setDataStateCode(String dataStateCode) {
        this.dataStateCode = dataStateCode;
    }

    public String getDataStateName() {
        return dataStateName;
    }

    public void setDataStateName(String dataStateName) {
        this.dataStateName = dataStateName;
    }
}
