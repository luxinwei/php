package com.gdlion.dpi.domain.vo.monitor;

import java.io.Serializable;

/**
 * Created by zhao on 2018/2/3.
 */
public class FirstThreeEventVO implements Serializable {

    private static final long serialVersionUID = 3594537158856975005L;

    private String eventId;

    /**
     * 部件ID(装置ID)
     */
    private Long partId;

    /**
     * 事件类型
     */
    private String type;

    /**
     * 发生时间
     */
    private String time;

    /**
     * 时间内容
     */
    private String content;

    /**
     * 告警状态（0：未处理，1：已处理）
     */
    private String state;

    private String buildingName;//所属建构筑物

    private String impName;//所属重点部位

    private String deviceName;//所属设施

    private String msgConfirm;//消息确认

    private String disposeTime;//处理时间

    private String result;//处理结果

    public static long getSerialVersionUID() {
        return serialVersionUID;
    }

    public String getEventId() {
        return eventId;
    }

    public void setEventId(String eventId) {
        this.eventId = eventId;
    }

    public Long getPartId() {
        return partId;
    }

    public void setPartId(Long partId) {
        this.partId = partId;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getTime() {
        return time;
    }

    public void setTime(String time) {
        this.time = time;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public String getBuildingName() {
        return buildingName;
    }

    public void setBuildingName(String buildingName) {
        this.buildingName = buildingName;
    }

    public String getImpName() {
        return impName;
    }

    public void setImpName(String impName) {
        this.impName = impName;
    }

    public String getDeviceName() {
        return deviceName;
    }

    public void setDeviceName(String deviceName) {
        this.deviceName = deviceName;
    }

    public String getMsgConfirm() {
        return msgConfirm;
    }

    public void setMsgConfirm(String msgConfirm) {
        this.msgConfirm = msgConfirm;
    }

    public String getDisposeTime() {
        return disposeTime;
    }

    public void setDisposeTime(String disposeTime) {
        this.disposeTime = disposeTime;
    }

    public String getResult() {
        return result;
    }

    public void setResult(String result) {
        this.result = result;
    }
}
