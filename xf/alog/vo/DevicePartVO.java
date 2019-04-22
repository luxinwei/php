package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import java.math.BigInteger;

/**
 * 设施部件
 * Created by zhang on 2018/1/8
 */
public class DevicePartVO extends BaseEntity {

    private static final long serialVersionUID = 7574280086096712733L;

    /** 所属业主单位 */
    private Long depId;

    @Length(message = "所属消防设施长度应为1-10字符",min = 1,max = 10)
    private Long deviceId;

    @NotNull(message = "所属建筑不能为空")
    private Long buildingId;

    /** 所属通讯模组 */
    private Long moduleId;

    @NotBlank(message = "部件名称不能为空")
    @Length(message = "部件名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    //TODO 字典项待完善
    @DictionaryCodeValidate(message = "部件类型不合法",dictionaryData = "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31")
    private String partTypeCode;

    @NotNull(message = "所有楼层不能为空")
    private Integer floor;

    @NotBlank(message = "部件型号不能为空")
    @DictionaryCodeValidate(message = "部件型号不合法",dictionaryData = "")
    private String model;

    @Length(message = "部件区号长度应为1-100字符",min = 1,max = 100)
    private String areaNum;

    @Length(message = "部件回路号长度应为1-100字符",min = 1,max = 100)
    private String circuitNum;

    @Length(message = "部件位号长度应为1-100字符",min = 1,max = 100)
    private String bitNum;

    @Length(message = "安装位置长度应为1-100字符",min = 1,max = 100)
    private String position;

    @DictionaryCodeValidate(message = "部件状态不合法",dictionaryData = "01,10,20,99")
    private String state;

    @NotNull(message = "模板id不能为空")
    private Long templateId;

    @Length(message = "描述信息长度应为1-100字符",min = 1,max = 100)
    private String description;

    private String buildingName;//所属建构筑物名称

    private String depName;//所属业主单位名称

    private String deviceName;//所属消防设施名称

    private String moduleName;//所属通讯模组名称

    private String typeName;//类型名称

    private String stateName;//状态名称

    private String impName;//所属总点部位名称

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public Long getDeviceId() {
        return deviceId;
    }

    public void setDeviceId(Long deviceId) {
        this.deviceId = deviceId;
    }

    public Long getBuildingId() {
        return buildingId;
    }

    public void setBuildingId(Long buildingId) {
        this.buildingId = buildingId;
    }

    public Long getModuleId() {
        return moduleId;
    }

    public void setModuleId(Long moduleId) {
        this.moduleId = moduleId;
    }

    public void setTemplateId(Long templateId) {
        this.templateId = templateId;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPartTypeCode() {
        return partTypeCode;
    }

    public void setPartTypeCode(String partTypeCode) {
        this.partTypeCode = partTypeCode;
    }

    public Integer getFloor() {
        return floor;
    }

    public void setFloor(Integer floor) {
        this.floor = floor;
    }

    public String getModel() {
        return model;
    }

    public void setModel(String model) {
        this.model = model;
    }

    public String getAreaNum() {
        return areaNum;
    }

    public void setAreaNum(String areaNum) {
        this.areaNum = areaNum;
    }

    public String getCircuitNum() {
        return circuitNum;
    }

    public void setCircuitNum(String circuitNum) {
        this.circuitNum = circuitNum;
    }

    public String getBitNum() {
        return bitNum;
    }

    public void setBitNum(String bitNum) {
        this.bitNum = bitNum;
    }

    public String getPosition() {
        return position;
    }

    public void setPosition(String position) {
        this.position = position;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public Long getTemplateId() {
        return templateId;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
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

    public String getDeviceName() {
        return deviceName;
    }

    public void setDeviceName(String deviceName) {
        this.deviceName = deviceName;
    }

    public String getModuleName() {
        return moduleName;
    }

    public void setModuleName(String moduleName) {
        this.moduleName = moduleName;
    }

    public String getTypeName() {
        return typeName;
    }

    public void setTypeName(String typeName) {
        this.typeName = typeName;
    }

    public String getStateName() {
        return stateName;
    }

    public void setStateName(String stateName) {
        this.stateName = stateName;
    }

    public String getImpName() {
        return impName;
    }

    public void setImpName(String impName) {
        this.impName = impName;
    }
}
