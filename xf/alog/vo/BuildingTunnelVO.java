package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Digits;
import javax.validation.constraints.NotNull;
import java.math.BigDecimal;
import java.math.BigInteger;

/**
 * 建构筑物隧道
 * Created by zhang on 2018/1/7
 */
public class BuildingTunnelVO extends BaseEntity {

    private static final long serialVersionUID = 7976205806937717309L;

    @NotNull(message = "所属建构筑物id不能为空")
    private Long buildingId;

    @NotBlank(message = "隧道位置不能为空")
    @Length(message = "隧道位置长度应为1-200字符",min = 1,max = 200)
    private String position;

    @NotNull(message = "隧道高度不能为空")
    @Digits(message = "隧道高度不符合要求",integer = 8, fraction = 2)
    private BigDecimal height;

    @NotNull(message = "隧道长度不能为空")
    @Digits(message = "隧道长度不符合要求",integer = 8, fraction = 2)
    private BigDecimal length;

    private String buildingName;//所属建构筑物名称

    /** 所属单位名称 */
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

    public BigDecimal getHeight() {
        return height;
    }

    public void setHeight(BigDecimal height) {
        this.height = height;
    }

    public BigDecimal getLength() {
        return length;
    }

    public void setLength(BigDecimal length) {
        this.length = length;
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
