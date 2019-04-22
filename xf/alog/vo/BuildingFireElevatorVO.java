package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Digits;
import javax.validation.constraints.NotNull;
import java.math.BigDecimal;
import java.math.BigInteger;

/**
 * 建构筑物消防电梯
 * Created by zhang on 2018/1/7
 */
public class BuildingFireElevatorVO extends BaseEntity {

    private static final long serialVersionUID = -8953301654515390207L;

    @NotNull(message = "建构筑物所属id不能为空")
    private Long buildingId;

    @NotBlank(message = "消防电梯的位置不能为空")
    @Length(message = "消防电梯的位置长度应为1-200字符",min = 1,max = 200)
    private String position;

    @NotNull(message = "消防电梯载重量不能为空")
    @Digits(message = "消防电梯载重量不符合要求",integer = 8, fraction = 2)
    private BigDecimal holdWeight;

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

    public BigDecimal getHoldWeight() {
        return holdWeight;
    }

    public void setHoldWeight(BigDecimal holdWeight) {
        this.holdWeight = holdWeight;
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
