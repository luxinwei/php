package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.math.BigInteger;
import java.util.Date;

/**
 * 视屏监控管理
 * Created by zhang on 2018/1/7
 */
public class CameraMonitorVO extends BaseEntity {

    private static final long serialVersionUID = 6218128950127586729L;

    @NotBlank(message = "监控点名称不能为空")
    @Length(message = "监控点名称长度应为1-100字符",min = 1,max = 100)
    private String name;

    /** 主要部位id */
    private Long impPartId;

    private String impPartName;

    /** 所属设施 */
    private Long deviceId;

    private String deviceName;

    /** 所属建筑 */
    @NotNull(message = "所属建筑不能为空")
    private Long buildingId;

    private String buildingName;

    @NotBlank(message = "摄像头序列号不能为空")
    @Length(message = "摄像头序号长度应为1-50字符",min = 1,max = 50)
    private String code;

    @NotBlank(message = "摄像头验证码不能为空")
    @Length(message = "验证码长度应为1-50字符",min = 1,max = 50)
    private String authCode;

    @Length(message = "IP长度应为1-50字符",min = 1,max = 50)
    private String ip;

    @Length(message = "端口长度应为1-10字符",min = 1,max = 10)
    private String port;

    @NotBlank(message = "位置不能为空")
    @Length(message = "位置长度应为1-100字符",min = 1,max = 100)
    private String position;

    @NotNull(message = "所属楼层不能为空")
    private Integer floor;

    /** 楼层平面图，上传时是base64字符串*/
    private String file;

    /** 文件名称 */
    private String fileName;

    /** rtmp播放地址 */
    private String rtmpAddr;

    /** rtmp播放地址高清 */
    private String rtmpHdAddr;

    /** hls播放地址 */
    private String hlsAddr;

    /** hls播放地址高清 */
    private String hlsHdAddr;

    /*缩略图地址*/
    private String thumbUrl;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public Long getImpPartId() {
        return impPartId;
    }

    public void setImpPartId(Long impPartId) {
        this.impPartId = impPartId;
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

    public String getCode() {
        return code;
    }

    public void setCode(String code) {
        this.code = code;
    }

    public String getAuthCode() {
        return authCode;
    }

    public void setAuthCode(String authCode) {
        this.authCode = authCode;
    }

    public String getIp() {
        return ip;
    }

    public void setIp(String ip) {
        this.ip = ip;
    }

    public String getPort() {
        return port;
    }

    public void setPort(String port) {
        this.port = port;
    }

    public String getPosition() {
        return position;
    }

    public void setPosition(String position) {
        this.position = position;
    }

    public Integer getFloor() {
        return floor;
    }

    public void setFloor(Integer floor) {
        this.floor = floor;
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

    public String getRtmpAddr() {
        return rtmpAddr;
    }

    public void setRtmpAddr(String rtmpAddr) {
        this.rtmpAddr = rtmpAddr;
    }

    public String getRtmpHdAddr() {
        return rtmpHdAddr;
    }

    public void setRtmpHdAddr(String rtmpHdAddr) {
        this.rtmpHdAddr = rtmpHdAddr;
    }

    public String getHlsAddr() {
        return hlsAddr;
    }

    public void setHlsAddr(String hlsAddr) {
        this.hlsAddr = hlsAddr;
    }

    public String getHlsHdAddr() {
        return hlsHdAddr;
    }

    public void setHlsHdAddr(String hlsHdAddr) {
        this.hlsHdAddr = hlsHdAddr;
    }

    public String getImpPartName() {
        return impPartName;
    }

    public void setImpPartName(String impPartName) {
        this.impPartName = impPartName;
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

    public String getThumbUrl() {
        return thumbUrl;
    }

    public void setThumbUrl(String thumbUrl) {
        this.thumbUrl = thumbUrl;
    }
}
