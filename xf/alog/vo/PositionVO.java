package com.gdlion.dpi.domain.vo.monitor;

/**
 * Created by zhao on 2018/2/8.
 * 定位信息
 */
public class PositionVO {

    /*坐标*/
    private String position;

    /*坐标位置名称*/
    private String positionName;

    /*电话*/
    private String phone;

    /*联系人*/
    private String contacts;

    /*单位名称*/
    private String depName;

    public String getPosition() {
        return position;
    }

    public void setPosition(String position) {
        this.position = position;
    }

    public String getPositionName() {
        return positionName;
    }

    public void setPositionName(String positionName) {
        this.positionName = positionName;
    }

    public String getPhone() {
        return phone;
    }

    public void setPhone(String phone) {
        this.phone = phone;
    }

    public String getContacts() {
        return contacts;
    }

    public void setContacts(String contacts) {
        this.contacts = contacts;
    }

    public String getDepName() {
        return depName;
    }

    public void setDepName(String depName) {
        this.depName = depName;
    }
}
