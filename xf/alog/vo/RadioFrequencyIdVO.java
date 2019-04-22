package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;

public class RadioFrequencyIdVO extends BaseEntity{

    private static final long serialVersionUID = 7584829353029587855L;

    /** 印刷号  press_number **/
    private String pressNumber;

    /**   印刷号  press_number   **/
    public String getPressNumber() {
        return pressNumber;
    }

    /**   印刷号  press_number   **/
    public void setPressNumber(String pressNumber) {
        this.pressNumber = pressNumber == null ? null : pressNumber.trim();
    }
}