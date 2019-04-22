package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Digits;
import javax.validation.constraints.NotNull;
import java.math.BigDecimal;
import java.math.BigInteger;

/**
 * 建构筑物毗邻建筑物
 * Created by zhang on 2018/1/7
 */
public class AdjacentBuildingVO extends BaseEntity {

    private static final long serialVersionUID = 1216043010061716232L;

    @NotNull(message = "所属建构筑物id不能为空")
    private Long buildingId;

    /** 扩展预留字段 */
    @Length(message = "所属建构筑物类型的长度应为1-50字符",min = 1,max = 50)
    private String buildingType;

    @NotBlank(message = "毗邻建筑的方向不能为空")
    @DictionaryCodeValidate(message = "毗邻建筑方向不符合规范",dictionaryData = "1,2,3,4,5,6,7,8")
    private String buildingDrectionCode;

    private String buildingDrectionName;

    @NotBlank(message = "建筑物名称不能为空")
    @Length(message = "建筑物名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    @NotBlank(message = "建筑物使用性质不能为空")
    @DictionaryCodeValidate(message = "建筑物使用性质不符合规范",dictionaryData = "01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,99")
    private String buildingUseKindCode;

    private String buildingUseKindName;

    @NotBlank(message = "建筑物结构类型不能为空")
    @DictionaryCodeValidate(message = "建筑物结构类型不符合规范",dictionaryData = "1,2,3,4,5,9")
    private String buildingStructureCode;

    private String buildingStructureName;

    @NotNull(message = "建筑物高度不能为空")
    @Digits(message = "建筑物高度不符合要求",integer = 8, fraction = 2)
    private BigDecimal height;

    @NotNull(message = "与本建筑物的距离不能为空")
    @Digits(message = "与本建筑物的距离不符合要求",integer = 8, fraction = 2)
    private BigDecimal standoffDistance;

    private String buildingName;//所属建构筑物名称

    private String depName;

    public Long getBuildingId() {
        return buildingId;
    }

    public void setBuildingId(Long buildingId) {
        this.buildingId = buildingId;
    }

    public String getBuildingType() {
        return buildingType;
    }

    public void setBuildingType(String buildingType) {
        this.buildingType = buildingType;
    }

    public String getBuildingDrectionCode() {
        return buildingDrectionCode;
    }

    public void setBuildingDrectionCode(String buildingDrectionCode) {
        this.buildingDrectionCode = buildingDrectionCode;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getBuildingUseKindCode() {
        return buildingUseKindCode;
    }

    public void setBuildingUseKindCode(String buildingUseKindCode) {
        this.buildingUseKindCode = buildingUseKindCode;
    }

    public String getBuildingStructureCode() {
        return buildingStructureCode;
    }

    public void setBuildingStructureCode(String buildingStructureCode) {
        this.buildingStructureCode = buildingStructureCode;
    }

    public BigDecimal getHeight() {
        return height;
    }

    public void setHeight(BigDecimal height) {
        this.height = height;
    }

    public BigDecimal getStandoffDistance() {
        return standoffDistance;
    }

    public void setStandoffDistance(BigDecimal standoffDistance) {
        this.standoffDistance = standoffDistance;
    }

    public String getBuildingName() {
        return buildingName;
    }

    public void setBuildingName(String buildingName) {
        this.buildingName = buildingName;
    }

    public String getBuildingDrectionName() {
        return buildingDrectionName;
    }

    public void setBuildingDrectionName(String buildingDrectionName) {
        this.buildingDrectionName = buildingDrectionName;
    }

    public String getBuildingUseKindName() {
        return buildingUseKindName;
    }

    public void setBuildingUseKindName(String buildingUseKindName) {
        this.buildingUseKindName = buildingUseKindName;
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
