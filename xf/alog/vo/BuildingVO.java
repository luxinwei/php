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
 * 建构筑物
 * Created by zhang on 2018/1/7
 */
public class BuildingVO extends BaseEntity {

    private static final long serialVersionUID = 3950474060175796338L;

    @NotNull(message = "所属业主单位id不能为空")
    private Long depId;

    @NotBlank(message = "建构筑物名称不能为空")
    @Length(message = "建构筑物名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    @NotBlank(message = "建筑物分类类别不能为空")
    @DictionaryCodeValidate(message = "建筑物分类类别不符合规范",dictionaryData = "01,02,03,04,05,06,07,08,09,99")
    private String buildingTypeCode;

    private String buildingTypeName;

    @Past(message = "建构筑物建造日期异常")
    @NotNull(message = "建造日期不能为空")
    private Date buildTime;

    @NotBlank(message = "建构筑物使用性质不能为空")
    @DictionaryCodeValidate(message = "使用性质不符合规范",dictionaryData = "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,99")
    private String buildingUseKindCode;

    private String buildingUseKindName;

    @NotBlank(message = "火灾危险性不能为空")
    @DictionaryCodeValidate(message = "火灾危险性不符合规范",dictionaryData = "1,2,3,4,5,6")
    private String buildingFireDangerCode;

    private String buildingFireDangerName;

    @NotBlank(message = "耐火等级不能为空")
    @DictionaryCodeValidate(message = "耐火等级不符合规范",dictionaryData = "1,2,3,4")
    private String buildingResistFireCode;

    private String buildingResistFireName;

    @NotBlank(message = "结构类型不能为空")
    @DictionaryCodeValidate(message = "结构类型不符合规范",dictionaryData = "1,2,3,4,5,9")
    private String buildingStructureCode;

    private String buildingStructureName;

    @NotNull(message = "建筑高度不能为空")
    @Digits(message = "建筑高度不符合要求",integer = 4, fraction = 2)
    private BigDecimal buildHeight;

    @NotNull(message = "建筑面积不能为空")
    @Digits(message = "建筑面积不符合要求",integer = 8, fraction = 2)
    private BigDecimal overallFloorage;

    @Digits(message = "建筑占地面积不符合要求",integer = 8, fraction = 2)
    private BigDecimal floorSpace;

    @Digits(message = "标准层面积不符合要求",integer = 8, fraction = 2)
    private BigDecimal standardFloorage;

    @NotNull(message = "地上层数不能为空")
    @Digits(message = "地上层数不符合要求",integer = 3, fraction = 0)
    private Integer aboveGroundFloors;

    @Digits(message = "地上层面积不符合要求",integer = 8, fraction = 2)
    private BigDecimal aboveGroundArea;

    @NotNull(message = "地下层数不能为空")
    @Digits(message = "地下层数不符合要求",integer = 3, fraction = 0)
    private Integer underGroundFloors;

    @Digits(message = "地下层面积不符合要求",integer = 8, fraction = 2)
    private BigDecimal underGroundArea;

    @Min(message = "日常工作时间人数不是必填项，否则最少1人",value = 0)
    @Max(message = "日常工作时间人数最多为99999人",value = 99999)
    private Integer workerNum;

    @Min(message = "最大容纳人数不是必填项，否则最少1人",value = 0)
    @Max(message = "最大容纳人数最多为99999人",value = 99999)
    private Integer maxnumCapacity;

    @Length(message = "消防控制室长度应为1-100字符",min = 1,max = 100)
    private String controlRoomPosition;

    /** 消防控制室人，关联用户id */
    @Length(message = "消防控制室联系人长度应为1-20字符",min = 1,max = 20)
    private String controlRoomPerson;

    @Length(message = "消防控制室电话长度应为3-15字符",min = 3,max = 15)
    private String controlRoomPhone;

    private String depName;

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

    public Date getBuildTime() {
        return buildTime;
    }

    public void setBuildTime(Date buildTime) {
        this.buildTime = buildTime;
    }

    public BigDecimal getBuildHeight() {
        return buildHeight;
    }

    public void setBuildHeight(BigDecimal buildHeight) {
        this.buildHeight = buildHeight;
    }

    public BigDecimal getOverallFloorage() {
        return overallFloorage;
    }

    public void setOverallFloorage(BigDecimal overallFloorage) {
        this.overallFloorage = overallFloorage;
    }

    public BigDecimal getFloorSpace() {
        return floorSpace;
    }

    public void setFloorSpace(BigDecimal floorSpace) {
        this.floorSpace = floorSpace;
    }

    public BigDecimal getStandardFloorage() {
        return standardFloorage;
    }

    public void setStandardFloorage(BigDecimal standardFloorage) {
        this.standardFloorage = standardFloorage;
    }

    public Integer getAboveGroundFloors() {
        return aboveGroundFloors;
    }

    public void setAboveGroundFloors(Integer aboveGroundFloors) {
        this.aboveGroundFloors = aboveGroundFloors;
    }

    public BigDecimal getAboveGroundArea() {
        return aboveGroundArea;
    }

    public void setAboveGroundArea(BigDecimal aboveGroundArea) {
        this.aboveGroundArea = aboveGroundArea;
    }

    public Integer getUnderGroundFloors() {
        return underGroundFloors;
    }

    public void setUnderGroundFloors(Integer underGroundFloors) {
        this.underGroundFloors = underGroundFloors;
    }

    public BigDecimal getUnderGroundArea() {
        return underGroundArea;
    }

    public void setUnderGroundArea(BigDecimal underGroundArea) {
        this.underGroundArea = underGroundArea;
    }

    public Integer getWorkerNum() {
        return workerNum;
    }

    public void setWorkerNum(Integer workerNum) {
        this.workerNum = workerNum;
    }

    public Integer getMaxnumCapacity() {
        return maxnumCapacity;
    }

    public void setMaxnumCapacity(Integer maxnumCapacity) {
        this.maxnumCapacity = maxnumCapacity;
    }

    public String getControlRoomPosition() {
        return controlRoomPosition;
    }

    public void setControlRoomPosition(String controlRoomPosition) {
        this.controlRoomPosition = controlRoomPosition;
    }

    public String getBuildingTypeCode() {
        return buildingTypeCode;
    }

    public void setBuildingTypeCode(String buildingTypeCode) {
        this.buildingTypeCode = buildingTypeCode;
    }

    public String getControlRoomPerson() {
        return controlRoomPerson;
    }

    public void setControlRoomPerson(String controlRoomPerson) {
        this.controlRoomPerson = controlRoomPerson;
    }

    public String getControlRoomPhone() {
        return controlRoomPhone;
    }

    public void setControlRoomPhone(String controlRoomPhone) {
        this.controlRoomPhone = controlRoomPhone;
    }

    public String getBuildingUseKindCode() {
        return buildingUseKindCode;
    }

    public void setBuildingUseKindCode(String buildingUseKindCode) {
        this.buildingUseKindCode = buildingUseKindCode;
    }

    public String getBuildingFireDangerCode() {
        return buildingFireDangerCode;
    }

    public void setBuildingFireDangerCode(String buildingFireDangerCode) {
        this.buildingFireDangerCode = buildingFireDangerCode;
    }

    public String getBuildingResistFireCode() {
        return buildingResistFireCode;
    }

    public void setBuildingResistFireCode(String buildingResistFireCode) {
        this.buildingResistFireCode = buildingResistFireCode;
    }

    public String getBuildingStructureCode() {
        return buildingStructureCode;
    }

    public void setBuildingStructureCode(String buildingStructureCode) {
        this.buildingStructureCode = buildingStructureCode;
    }

    public String getBuildingTypeName() {
        return buildingTypeName;
    }

    public void setBuildingTypeName(String buildingTypeName) {
        this.buildingTypeName = buildingTypeName;
    }

    public String getBuildingUseKindName() {
        return buildingUseKindName;
    }

    public void setBuildingUseKindName(String buildingUseKindName) {
        this.buildingUseKindName = buildingUseKindName;
    }

    public String getBuildingFireDangerName() {
        return buildingFireDangerName;
    }

    public void setBuildingFireDangerName(String buildingFireDangerName) {
        this.buildingFireDangerName = buildingFireDangerName;
    }

    public String getBuildingResistFireName() {
        return buildingResistFireName;
    }

    public void setBuildingResistFireName(String buildingResistFireName) {
        this.buildingResistFireName = buildingResistFireName;
    }

    public String getBuildingStructureName() {
        return buildingStructureName;
    }

    public void setBuildingStructureName(String buildingStructureName) {
        this.buildingStructureName = buildingStructureName;
    }

    public String getDepName() {
        return depName;
    }

    public void setDepName(String depName) {
        this.depName = depName;
    }
}
