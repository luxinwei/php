package com.gdlion.dpi.domain.vo.monitor;

/**
 * Created by zhao on 2018/2/4.
 * <p>
 * 统计
 */
public class StatisticsVO {

    /*名称*/
    private String name;

    /*最大值*/
    private String maxValue;

    /*最大值 时间*/
    private String maxTime;

    /*最小值*/
    private String minValue;

    /*最小值 时间*/
    private String minTime;

    /*平均值*/
    private String meanValue;

    /*差值*/
    private String differenceValue;

    /*率*/
    private String rate;

    /*差率*/
    private String differenceRate;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getMaxValue() {
        return maxValue;
    }

    public void setMaxValue(String maxValue) {
        this.maxValue = maxValue;
    }

    public String getMaxTime() {
        return maxTime;
    }

    public void setMaxTime(String maxTime) {
        this.maxTime = maxTime;
    }

    public String getMinValue() {
        return minValue;
    }

    public void setMinValue(String minValue) {
        this.minValue = minValue;
    }

    public String getMinTime() {
        return minTime;
    }

    public void setMinTime(String minTime) {
        this.minTime = minTime;
    }

    public String getMeanValue() {
        return meanValue;
    }

    public void setMeanValue(String meanValue) {
        this.meanValue = meanValue;
    }

    public String getDifferenceValue() {
        return differenceValue;
    }

    public void setDifferenceValue(String differenceValue) {
        this.differenceValue = differenceValue;
    }

    public String getRate() {
        return rate;
    }

    public void setRate(String rate) {
        this.rate = rate;
    }

    public String getDifferenceRate() {
        return differenceRate;
    }

    public void setDifferenceRate(String differenceRate) {
        this.differenceRate = differenceRate;
    }
}
