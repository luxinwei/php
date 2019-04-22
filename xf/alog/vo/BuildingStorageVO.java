package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Digits;
import javax.validation.constraints.NotNull;
import java.math.BigDecimal;
import java.math.BigInteger;

/**
 * 建构筑物存储物
 * Created by zhang on 2018/1/6
 */
public class BuildingStorageVO extends BaseEntity {

    private static final long serialVersionUID = -8646315306435238028L;

    @NotNull(message = "所属建构筑物id不能为空")
    private Long buildingId;

    @NotBlank(message = "存储物名称不能为空")
    @Length(message = "存储物名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    @NotNull(message = "存储物数量不能为空")
    @Digits(message = "存储物数量不符合要求",integer = 5, fraction = 0)
    private Integer number;

    @NotBlank(message = "存储物性质不能为空")
    @Length(message = "存储物性质长度应为1-50字符",min = 1,max = 50)
    private String nature;

    //TODO 需要扩展字典表
    @NotBlank(message = "存储物形态不能为空")
    @Length(message = "存储物形态长度应为1-50字符",min = 1,max = 50)
    private String shape;

    @NotNull(message = "存储容积不能为空")
    @Digits(message = "存储物容积不符合要求",integer = 8, fraction = 2)
    private BigDecimal cubage;

    @Length(message = "主要原料长度应为1-50字符",min = 1,max = 50)
    private String mainMaterial;

    @Length(message = "主要产品长度应为1-50字符",min = 1,max = 50)
    private String mainProduct;

    private String buildingName;//所属建构筑物名称

    private String depName;

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

    public Integer getNumber() {
        return number;
    }

    public void setNumber(Integer number) {
        this.number = number;
    }

    public String getNature() {
        return nature;
    }

    public void setNature(String nature) {
        this.nature = nature;
    }

    public String getShape() {
        return shape;
    }

    public void setShape(String shape) {
        this.shape = shape;
    }

    public BigDecimal getCubage() {
        return cubage;
    }

    public void setCubage(BigDecimal cubage) {
        this.cubage = cubage;
    }

    public String getMainMaterial() {
        return mainMaterial;
    }

    public void setMainMaterial(String mainMaterial) {
        this.mainMaterial = mainMaterial;
    }

    public String getMainProduct() {
        return mainProduct;
    }

    public void setMainProduct(String mainProduct) {
        this.mainProduct = mainProduct;
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
}
