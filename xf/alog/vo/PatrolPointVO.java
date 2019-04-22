package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import java.math.BigInteger;

/**
 * 巡查点名称
 * Created by wangyuan on 2018/1/6
 */
public class PatrolPointVO extends BaseEntity {

    private static final long serialVersionUID = 2242028403252690665L;

    /** 唯一标示，自动生产UUID */
    private String uuid;

    /** 所属建筑id */
    @NotNull(message = "所属建筑id不能为空")
    private Long buildingId;

    /** 所属建筑名称 */
    private String buildingName;

    /** 关联的重点部位id  */
    private Long importantPartId;

    /** 重点部位名称 */
    private String importantPartName;

    /** 关联的设施id */
    private Long deviceId;
    /** 重点部位和设施至少选择一个 */

    /** 设施名称 */
    private String deviceName;

    @NotNull(message = "所在楼层不能为空")
    private Integer floor;

    @NotBlank(message = "巡查点名称不能为空")
    @Length(message = "巡查点名称长度应为1-50字符", min = 1, max = 50)
    private String name;

    @NotBlank(message = "巡查位置不能为空")
    @Length(message = "巡查位置长度应为1-100字符", min = 1, max = 100)
    private String position;

    @Length(message = "区号长度应为1-20字符", min = 1, max = 20)
    private String areaNum;

    @Length(message = "位号长度应为1-20字符", min = 1, max = 20)
    private String bitNum;

    @Length(message = "RFID标签长度应为1-30字符", min = 1, max = 30)
    private String rfidCode;

    /** 巡检标准，多个英文逗号分隔 */
    private String standardIds;

    public String getUuid() {
        return uuid;
    }

    public void setUuid(String uuid) {
        this.uuid = uuid;
    }

    public Long getBuildingId() {
        return buildingId;
    }

    public void setBuildingId(Long buildingId) {
        this.buildingId = buildingId;
    }

    public Long getImportantPartId() {
        return importantPartId;
    }

    public void setImportantPartId(Long importantPartId) {
        this.importantPartId = importantPartId;
    }

    public Long getDeviceId() {
        return deviceId;
    }

    public void setDeviceId(Long deviceId) {
        this.deviceId = deviceId;
    }

    public Integer getFloor() {
        return floor;
    }

    public void setFloor(Integer floor) {
        this.floor = floor;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPosition() {
        return position;
    }

    public void setPosition(String position) {
        this.position = position;
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

    public String getRfidCode() {
        return rfidCode;
    }

    public void setRfidCode(String rfidCode) {
        this.rfidCode = rfidCode;
    }

    public String getStandardIds() {
        return standardIds;
    }

    public void setStandardIds(String standardIds) {
        this.standardIds = standardIds;
    }

    public String getImportantPartName() {
        return importantPartName;
    }

    public void setImportantPartName(String importantPartName) {
        this.importantPartName = importantPartName;
    }

    public String getDeviceName() {
        return deviceName;
    }

    public void setDeviceName(String deviceName) {
        this.deviceName = deviceName;
    }

    public String getBuildingName() {
        return buildingName;
    }

    public void setBuildingName(String buildingName) {
        this.buildingName = buildingName;
    }
}
