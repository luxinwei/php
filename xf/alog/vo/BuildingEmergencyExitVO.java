package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import java.math.BigInteger;

/**
 * 建构筑物安全出口
 * Created by zhang on 2018/1/7
 */
public class BuildingEmergencyExitVO extends BaseEntity {

    private static final long serialVersionUID = 6887212629071046888L;
    
    @NotNull(message = "所属建构筑物id不能为空")
    private Long buildingId;

    @NotBlank(message = "安全出口位置不能为空")
    @Length(message = "安全出口的长度应为1-200字符",min = 1,max = 200)
    private String position;

    @NotBlank(message = "安全出口的形式不能为空")
    @Length(message = "安全出口的形式长度应为1-50字符",min = 1,max = 50)
    private String modality;

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

    public String getModality() {
        return modality;
    }

    public void setModality(String modality) {
        this.modality = modality;
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
