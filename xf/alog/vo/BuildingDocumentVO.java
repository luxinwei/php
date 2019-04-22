package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Max;
import javax.validation.constraints.Min;
import javax.validation.constraints.NotNull;
import java.math.BigInteger;

/**
 * 建筑物相关图档
 * Created by zhang on 2018/1/7
 */
public class BuildingDocumentVO extends BaseEntity {

    private static final long serialVersionUID = 2582686396289924396L;

    @NotNull(message = "所属建构筑物id不能为空")
    private Long buildingId;

    /** 扩展预留字段 */
    @Length(message = "建构筑物类型长度应为1-50字符",min = 1,max = 50)
    private String buildingType;

    @NotBlank(message = "图档类型不能为空")
    @DictionaryCodeValidate(message = "图档类型不符合规范", dictionaryData = "1,2,3")
    private String buildingImgDocCode;

    private String buildingImgDocName;

    @Min(message = "地下层数最多9层",value = -9)
    @Max(message = "地上层数最多999层", value = 999)
    private Integer floor;

    @Length(message = "图档描述应为1-100字符",min = 1,max = 100)
    private String description;

    @NotBlank(message = "图档文件不能为空")
    private String file;

    @NotBlank(message = "文件名称不能为空")
    private String fileName;

    /*建构筑物名称*/
    private String buildingName;

    /*上传时间*/
    private Long time;

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

    public String getBuildingImgDocCode() {
        return buildingImgDocCode;
    }

    public void setBuildingImgDocCode(String buildingImgDocCode) {
        this.buildingImgDocCode = buildingImgDocCode;
    }

    public Integer getFloor() {
        return floor;
    }

    public void setFloor(Integer floor) {
        this.floor = floor;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
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

    public String getBuildingImgDocName() {
        return buildingImgDocName;
    }

    public void setBuildingImgDocName(String buildingImgDocName) {
        this.buildingImgDocName = buildingImgDocName;
    }

    public String getBuildingName() {
        return buildingName;
    }

    public void setBuildingName(String buildingName) {
        this.buildingName = buildingName;
    }

    public Long getTime() {
        return time;
    }

    public void setTime(Long time) {
        this.time = time;
    }
}
