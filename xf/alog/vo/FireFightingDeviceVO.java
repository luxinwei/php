package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.Digits;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.math.BigDecimal;
import java.math.BigInteger;
import java.util.Date;

/**
 * 消防设施管理
 * Created by zhang on 2018/1/8
 */
public class FireFightingDeviceVO extends BaseEntity {

    private static final long serialVersionUID = -953941526513381080L;

    @NotNull(message = "所属业主单位id不为空")
    private Long depId;

    @NotNull(message = "所属建筑不能为空")
    private Long buildingId;

    /**  所属重点部位，可选 */
    private Long impPartId;

    /** 所属设施id */
    private Long parentId;

    @NotBlank(message = "设施名称不能为空")
    @Length(message = "所属设施名称长度为1-100字符",min = 1,max = 100)
    private String name;

    @NotBlank(message = "设施系统形式不能为空")
    @DictionaryCodeValidate(message = "设施系统形式不能为空", dictionaryData = "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20")
    private String systemForm;

    private String systemFormName;

    @NotNull(message = "楼层号不能为空")
    private Integer floor;

    @Length(message = "区号长度应为1-100字符",min = 1,max = 100)
    private String areaNum;

    @Length(message = "位号长度应为1-100字符",min = 1,max = 100)
    private String bitNum;

    @Past(message = "投入使用时间异常")
    private Date serviceTime;

    @NotNull(message = "设施系统类型")
    @DictionaryCodeValidate(message = "设施类型不能为空",dictionaryData = "1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21")
    private String deviceType;

    private String deviceTypeName;

    @NotBlank(message = "设施服务状态不能为空")
    @DictionaryCodeValidate(message = "设施服务状态不符合规范", dictionaryData = "0,1,2,9")
    private String serviceStateCode;

    private String serviceStateName;

    @NotNull(message = "设施型号不能为空")
    @Length(message = "设施型号长度应为1-50字符", min = 1, max = 50)
    private String model;

    @NotBlank(message = "生产单位名称不能为空")
    @Length(message = "生产单位名称长度应为1-50字符",min = 1,max = 50)
    private String productName;

    @Length(message = "生产单位电话长度应为3-15字符",min = 3,max = 15)
    private String productTel;

    @Length(message = "维修保养单位名称长度应为1-50字符",min = 1,max = 50)
    private String maintenanceName;

    @Length(message = "维修保养单位电话长度应为3-15字符",min = 3,max = 15)
    private String maintenanceTel;

    @NotBlank(message = "设施状态不能为空")
    @DictionaryCodeValidate(message = "设施状态不符合规范", dictionaryData = "01,10,20,99")
    private String runStateCode;

    private String runStateName;

    @Length(message = "状态描述长度应为1-100字符",min = 1,max = 100)
    private String stateDescription;

    /** 状态变化时间 */
    private Date stateChangeTime;

    @Length(message = "绑定摄像头长度应为1-30字符",min = 1,max = 30)
    private String cameraNum;

    @Length(message = "摄像头拍摄位长度应为1-30字符",min = 1,max = 30)
    private String shootingAngle;

    /** 暂定状态 1:暂停  0:不暂停 */
    private Integer pauseFlag;

    @Length(message = "位置长度应为1-100字符",min = 1,max = 100)
    private String position;

    /** 数量 */
    private Integer count;
    /** 备用数量 */
    private Integer count1;
    /** 备用数量 */
    private Integer count2;
    /** 备用数量 */
    private Integer count3;

    private String buildingName;//所属建构筑物名称

    private String depName;//所属业主单位名称

    private String impPartName;//所属重点部位名称

    private String parentName;//所属设施名称

    @Digits(message = "容量不符合要求",integer = 8, fraction = 2)
    private BigDecimal capacity;

    /** 上传的平面图 */
    private String file;

    /** 文件名 */
    private String fileName;

    /** 平面图图标位置 */
    private String iconPosition;

    /** 明细json数据 */
    private String data;

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public Long getBuildingId() {
        return buildingId;
    }

    public void setBuildingId(Long buildingId) {
        this.buildingId = buildingId;
    }

    public Long getImpPartId() {
        return impPartId;
    }

    public void setImpPartId(Long impPartId) {
        this.impPartId = impPartId;
    }

    public Long getParentId() {
        return parentId;
    }

    public void setParentId(Long parentId) {
        this.parentId = parentId;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getSystemForm() {
        return systemForm;
    }

    public void setSystemForm(String systemForm) {
        this.systemForm = systemForm;
    }

    public Integer getFloor() {
        return floor;
    }

    public void setFloor(Integer floor) {
        this.floor = floor;
    }

    public String getAreaNum() {
        return areaNum;
    }

    public void setAreaNum(String areaNum) {
        this.areaNum = areaNum;
    }

    public String getBitNum() {
        return bitNum;
    }

    public void setBitNum(String bitNum) {
        this.bitNum = bitNum;
    }

    public Date getServiceTime() {
        return serviceTime;
    }

    public void setServiceTime(Date serviceTime) {
        this.serviceTime = serviceTime;
    }

    public String getDeviceType() {
        return deviceType;
    }

    public void setDeviceType(String deviceType) {
        this.deviceType = deviceType;
    }

    public String getServiceStateCode() {
        return serviceStateCode;
    }

    public void setServiceStateCode(String serviceStateCode) {
        this.serviceStateCode = serviceStateCode;
    }

    public String getModel() {
        return model;
    }

    public void setModel(String model) {
        this.model = model;
    }

    public String getProductName() {
        return productName;
    }

    public void setProductName(String productName) {
        this.productName = productName;
    }

    public String getProductTel() {
        return productTel;
    }

    public void setProductTel(String productTel) {
        this.productTel = productTel;
    }

    public String getMaintenanceName() {
        return maintenanceName;
    }

    public void setMaintenanceName(String maintenanceName) {
        this.maintenanceName = maintenanceName;
    }

    public String getMaintenanceTel() {
        return maintenanceTel;
    }

    public void setMaintenanceTel(String maintenanceTel) {
        this.maintenanceTel = maintenanceTel;
    }

    public String getRunStateCode() {
        return runStateCode;
    }

    public void setRunStateCode(String runStateCode) {
        this.runStateCode = runStateCode;
    }

    public String getStateDescription() {
        return stateDescription;
    }

    public void setStateDescription(String stateDescription) {
        this.stateDescription = stateDescription;
    }

    public Date getStateChangeTime() {
        return stateChangeTime;
    }

    public void setStateChangeTime(Date stateChangeTime) {
        this.stateChangeTime = stateChangeTime;
    }

    public String getCameraNum() {
        return cameraNum;
    }

    public void setCameraNum(String cameraNum) {
        this.cameraNum = cameraNum;
    }

    public Integer getPauseFlag() {
        return pauseFlag;
    }

    public void setPauseFlag(Integer pauseFlag) {
        this.pauseFlag = pauseFlag;
    }

    public String getPosition() {
        return position;
    }

    public void setPosition(String position) {
        this.position = position;
    }

    public Integer getCount() {
        return count;
    }

    public void setCount(Integer count) {
        this.count = count;
    }

    public Integer getCount1() {
        return count1;
    }

    public void setCount1(Integer count1) {
        this.count1 = count1;
    }

    public Integer getCount2() {
        return count2;
    }

    public void setCount2(Integer count2) {
        this.count2 = count2;
    }

    public Integer getCount3() {
        return count3;
    }

    public void setCount3(Integer count3) {
        this.count3 = count3;
    }

    public BigDecimal getCapacity() {
        return capacity;
    }

    public void setCapacity(BigDecimal capacity) {
        this.capacity = capacity;
    }

    public String getFile() {
        return file;
    }

    public void setFile(String file) {
        this.file = file;
    }

    public String getData() {
        return data;
    }

    public void setData(String data) {
        this.data = data;
    }

    public String getShootingAngle() {
        return shootingAngle;
    }

    public void setShootingAngle(String shootingAngle) {
        this.shootingAngle = shootingAngle;
    }

    public String getFileName() {
        return fileName;
    }

    public void setFileName(String fileName) {
        this.fileName = fileName;
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

    public String getImpPartName() {
        return impPartName;
    }

    public void setImpPartName(String impPartName) {
        this.impPartName = impPartName;
    }

    public String getServiceStateName() {
        return serviceStateName;
    }

    public void setServiceStateName(String serviceStateName) {
        this.serviceStateName = serviceStateName;
    }

    public String getRunStateName() {
        return runStateName;
    }

    public void setRunStateName(String runStateName) {
        this.runStateName = runStateName;
    }

    public String getSystemFormName() {
        return systemFormName;
    }

    public void setSystemFormName(String systemFormName) {
        this.systemFormName = systemFormName;
    }

    public String getDeviceTypeName() {
        return deviceTypeName;
    }

    public void setDeviceTypeName(String deviceTypeName) {
        this.deviceTypeName = deviceTypeName;
    }

    public String getParentName() {
        return parentName;
    }

    public void setParentName(String parentName) {
        this.parentName = parentName;
    }

    public String getIconPosition() {
        return iconPosition;
    }

    public void setIconPosition(String iconPosition) {
        this.iconPosition = iconPosition;
    }
}
