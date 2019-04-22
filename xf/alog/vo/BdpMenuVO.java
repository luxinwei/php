package com.gdlion.dpi.domain.vo.monitor;

import com.gdlion.dpi.domain.BaseEntity;

/**
 * 建筑、设施、部件树
 */
public class BdpMenuVO extends BaseEntity{

    private static final long serialVersionUID = -7195627558787794930L;

    /** 对应id */
    private Long id;

    /** name值 */
    private String name;

    @Override
    public Long getId() {
        return id;
    }

    @Override
    public void setId(Long id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }
}
