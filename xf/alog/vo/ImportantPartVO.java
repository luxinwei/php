package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.*;
import java.math.BigDecimal;
import java.math.BigInteger;
import java.util.Date;

/**
 * 重要部位
 * Created by zhang on 2018/1/7
 */
public class ImportantPartVO extends BaseEntity {

    private static final long serialVersionUID = 5876137879502174042L;

    /** 所属业主单位 */
    @NotNull(message = "所属业主单位不能为空")
    private Long depId;

    /** 管理责任，1:本单位管理，2:本单位使用*/
    @Min(message = "管理责任不符合规范", value = 1)
    @Max(message = "管理责任不符合规范", value = 2)
    @NotNull(message = "管理职责不能为空")
    private Integer dutyCode;

    /** 所属建构筑物类型  暂留扩展字段，目前不适用*/
    private String buildingType;

    @NotNull(message = "所属建构筑物不能为空")
    private Long buildingId;

    @NotBlank(message = "重点部位名称不能为空")
    @Length(message = "重点部位名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    @Digits(message = "建筑面积不符合要求",integer = 8, fraction = 2)
    private BigDecimal overallFloorage;

    @NotBlank(message = "耐火等级不能为空")
    @DictionaryCodeValidate(message = "耐火等级不符合规范",dictionaryData = "1,2,3,4")
    private String buildingResistFireCode;

    private String buildingResistFireName;

    @NotBlank(message = "所在位置不能为空")
    @Length(message = "所在位置长度应为1-200字符",min = 1,max = 200)
    private String position;

    @NotNull(message = "所在层数不能为空")
    private Integer floor;

    @NotBlank(message = "建构筑物使用性质不能为空")
    @DictionaryCodeValidate(message = "使用性质不符合规范",dictionaryData = "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,99")
    private String buildingUseKindCode;

    private String buildingUseKindName;

    @NotBlank(message = "责任人的姓名不能为空")
    @Length(message = "责任人的姓名长度应为1-50字符",min = 1,max = 50)
    private String chargePersonName;

    @NotBlank(message = "责任人身份证号不能为空")
    @Length(message = "责任人的省份证号长度应为18字符",min = 18,max = 18)
    private String chargePersonId;

    @NotBlank(message = "责任人电话不能为空")
    @Length(message = "责任人的电话长度应为3-15字符",min = 3,max = 15)
    private String chargePersonTel;

    @NotBlank(message = "确立消防安全重点部位原因不能为空")
    @DictionaryCodeValidate(message = "确立原因不符合规范",dictionaryData = "1,2,3,4,5", singleVal = false)
    private String establishReasonCode;

    @NotBlank(message = "消防标志设立情况不能为空")
    @DictionaryCodeValidate(message = "消防标志设立情况不符合规范",dictionaryData = "1,2,3,4")
    private String fireproofSignCode;

    private String fireproofSignName;

    @NotBlank(message = "危险源情况不能为空")
    @DictionaryCodeValidate(message = "危险源情况不符合规范",dictionaryData = "1,2,3,4,5,6,7,8,9,10", singleVal = false)
    private String dangerSourceCode;

    /** 关联的消防设施种类，多个英文逗号分割，添加设置关联重点部位时，实时更新 */
    @Length(message = "消防设施长度应为1-100字符",min = 1,max = 100)
    private String deviceTypeCondition;

    /**消防安全管理措施 0:没有  1:人防  2:技防  3:人防、技防都有 */
    private Integer managementAction;

    private String buildingName;//所属建构筑物名称

    private String depName;//所属业主单位名称

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public Integer getDutyCode() {
        return dutyCode;
    }

    public void setDutyCode(Integer dutyCode) {
        this.dutyCode = dutyCode;
    }

    public String getBuildingType() {
        return buildingType;
    }

    public void setBuildingType(String buildingType) {
        this.buildingType = buildingType;
    }

    public Long getBuildingId() {
        return buildingId;
    }

    public void setBuildingId(Long buildingId) {
        this.buildingId = buildingId;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public BigDecimal getOverallFloorage() {
        return overallFloorage;
    }

    public void setOverallFloorage(BigDecimal overallFloorage) {
        this.overallFloorage = overallFloorage;
    }


    public String getPosition() {
        return position;
    }

    public void setPosition(String position) {
        this.position = position;
    }

    public Integer getFloor() {
        return floor;
    }

    public void setFloor(Integer floor) {
        this.floor = floor;
    }


    public String getChargePersonName() {
        return chargePersonName;
    }

    public void setChargePersonName(String chargePersonName) {
        this.chargePersonName = chargePersonName;
    }

    public String getChargePersonId() {
        return chargePersonId;
    }

    public void setChargePersonId(String chargePersonId) {
        this.chargePersonId = chargePersonId;
    }

    public String getChargePersonTel() {
        return chargePersonTel;
    }

    public void setChargePersonTel(String chargePersonTel) {
        this.chargePersonTel = chargePersonTel;
    }

    public String getDeviceTypeCondition() {
        return deviceTypeCondition;
    }

    public void setDeviceTypeCondition(String deviceTypeCondition) {
        this.deviceTypeCondition = deviceTypeCondition;
    }

    public Integer getManagementAction() {
        return managementAction;
    }

    public void setManagementAction(Integer managementAction) {
        this.managementAction = managementAction;
    }

    public String getBuildingResistFireCode() {
        return buildingResistFireCode;
    }

    public void setBuildingResistFireCode(String buildingResistFireCode) {
        this.buildingResistFireCode = buildingResistFireCode;
    }

    public String getBuildingUseKindCode() {
        return buildingUseKindCode;
    }

    public void setBuildingUseKindCode(String buildingUseKindCode) {
        this.buildingUseKindCode = buildingUseKindCode;
    }

    public String getEstablishReasonCode() {
        return establishReasonCode;
    }

    public void setEstablishReasonCode(String establishReasonCode) {
        this.establishReasonCode = establishReasonCode;
    }

    public String getFireproofSignCode() {
        return fireproofSignCode;
    }

    public void setFireproofSignCode(String fireproofSignCode) {
        this.fireproofSignCode = fireproofSignCode;
    }

    public String getDangerSourceCode() {
        return dangerSourceCode;
    }

    public void setDangerSourceCode(String dangerSourceCode) {
        this.dangerSourceCode = dangerSourceCode;
    }

    public String getBuildingName() {
        return buildingName;
    }

    public void setBuildingName(String buildingName) {
        this.buildingName = buildingName;
    }

    public String getDepName() {
        return depName;
    }

    public void setDepName(String depName) {
        this.depName = depName;
    }

    public String getBuildingResistFireName() {
        return buildingResistFireName;
    }

    public void setBuildingResistFireName(String buildingResistFireName) {
        this.buildingResistFireName = buildingResistFireName;
    }

    public String getBuildingUseKindName() {
        return buildingUseKindName;
    }

    public void setBuildingUseKindName(String buildingUseKindName) {
        this.buildingUseKindName = buildingUseKindName;
    }

    public String getFireproofSignName() {
        return fireproofSignName;
    }

    public void setFireproofSignName(String fireproofSignName) {
        this.fireproofSignName = fireproofSignName;
    }

}
