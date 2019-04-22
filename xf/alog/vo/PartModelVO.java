package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;

/**
 * Created by wangyuan on 2018/1/30
 */
public class PartModelVO extends BaseEntity {

    private static final long serialVersionUID = 6242465880206849251L;

    /** 部件型号 */
    private String model;

    /** 所属厂商 */
    private Long mfId;

    /** 所属厂商id */
    private String mfName;

    public String getModel() {
        return model;
    }

    public void setModel(String model) {
        this.model = model;
    }

    public Long getMfId() {
        return mfId;
    }

    public void setMfId(Long mfId) {
        this.mfId = mfId;
    }

    public String getMfName() {
        return mfName;
    }

    public void setMfName(String mfName) {
        this.mfName = mfName;
    }
}
