package com.gdlion.dpi.domain.vo;

import java.io.Serializable;

@SuppressWarnings("serial")
public class NotifiesVO implements Serializable {

    private String id;//ID
    private String title;//标题
    private String content;//内容
    private Long ctime;//Long型时间
    private String time;//字符串时间
    private String result;//结果
    private String state;//状态（0：未处理，1：已处理，2：屏蔽）
    private String deviceId;//设备ID
    private String pointId;//测点ID
    private String userId;//用户ID
    private String userName;//用户名称
    private String type;//报警类型
    private String msgConfirm;//消息确认
    private Long acceptTime;//受理时间

    private String deviceName;//设备名称
    private String hlsAddr;//摄像头播放地址


    public NotifiesVO() {
    }

    public NotifiesVO(String id, String title, String content, String time) {
        super();
        this.id = id;
        this.title = title;
        this.content = content;
        this.time = time;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public String getTime() {
        return time;
    }

    public void setTime(String time) {
        this.time = time;
    }

    public String getResult() {
        return result;
    }

    public void setResult(String result) {
        this.result = result;
    }

    public Long getCtime() {
        return ctime;
    }

    public void setCtime(Long ctime) {
        this.ctime = ctime;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public String getDeviceId() {
        return deviceId;
    }

    public void setDeviceId(String deviceId) {
        this.deviceId = deviceId;
    }

    public String getPointId() {
        return pointId;
    }

    public void setPointId(String pointId) {
        this.pointId = pointId;
    }

    public String getUserId() {
        return userId;
    }

    public void setUserId(String userId) {
        this.userId = userId;
    }

    public String getUserName() {
        return userName;
    }

    public void setUserName(String userName) {
        this.userName = userName;
    }

    public String getDeviceName() {
        return deviceName;
    }

    public void setDeviceName(String deviceName) {
        this.deviceName = deviceName;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getMsgConfirm() {
        return msgConfirm;
    }

    public void setMsgConfirm(String msgConfirm) {
        this.msgConfirm = msgConfirm;
    }

    public Long getAcceptTime() {
        return acceptTime;
    }

    public void setAcceptTime(Long acceptTime) {
        this.acceptTime = acceptTime;
    }

    public String getHlsAddr() {
        return hlsAddr;
    }

    public void setHlsAddr(String hlsAddr) {
        this.hlsAddr = hlsAddr;
    }
}
