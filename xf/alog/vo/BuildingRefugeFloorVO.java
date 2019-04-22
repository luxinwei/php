package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Digits;
import javax.validation.constraints.NotNull;
import java.math.BigDecimal;
import java.math.BigInteger;

/**
 * 建构筑物避难所
 * Created by zhang on 2018/1/7
 */
public class BuildingRefugeFloorVO extends BaseEntity {

    private static final long serialVersionUID = -8735734398128848127L;

    @NotNull(message = "所属建构筑物id不能为空")
    private Long buildingId;

    @NotBlank(message = "避难所位置不能为空")
    @Length(message = "避难所位置长度应为1-200字符",min = 1,max = 200)
    private String position;

    @NotNull(message = "避难所面积不能为空")
    @Digits(message = "避难所面积不符合要求",integer = 8, fraction = 2)
    private BigDecimal acreage;

    private String buildingName;//所属建构筑物名称

    private String depName;

    public Long getBuildingId() {
        return buildingId;
    }

    public void setBuildingId(Long buildingId) {
        this.buildingId = buildingId;
    }

    public String getPosition() {
        return position;
    }

    public void setPosition(String position) {
        this.position = position;
    }

    public BigDecimal getAcreage() {
        return acreage;
    }

    public void setAcreage(BigDecimal acreage) {
        this.acreage = acreage;
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
