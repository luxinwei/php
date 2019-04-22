package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;

/**
 * Created by wangyuan on 2018/1/30
 */
public class ManufacturersVO extends BaseEntity {

    private static final long serialVersionUID = -5416749147550165304L;

    /** 厂商名称 */
    private String name;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }
}
