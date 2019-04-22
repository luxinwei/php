package com.gdlion.dpi.domain.vo.monitor;

import com.gdlion.dpi.domain.BaseEntity;

/**
 * 消防水源--联网监控
 */
public class FireWaterSourceVO extends BaseEntity {

    private static final long serialVersionUID = -2130559875134791851L;

    /** 部件id */
    private Long id;

    /** 水位 */
    private String level;

    /** 水压 */
    private String pressure;

    @Override
    public Long getId() {
        return id;
    }

    @Override
    public void setId(Long id) {
        this.id = id;
    }

    public String getLevel() {
        return level;
    }

    public void setLevel(String level) {
        this.level = level;
    }

    public String getPressure() {
        return pressure;
    }

    public void setPressure(String pressure) {
        this.pressure = pressure;
    }
}
