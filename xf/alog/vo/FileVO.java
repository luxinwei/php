package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.common.validate.DictionaryCodeValidate;
import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.util.Date;

/**
 * 文件管理
 * Created by zhang on 2018/1/7
 */
public class FileVO extends BaseEntity {

    private static final long serialVersionUID = -8649605795590031264L;

    /** 文件名称 */
    private String name;

    /** 文件类型 */
    private String type;

    /** 文件路径 */
    private String filePath;

    /** 文件描述 */
    private String description;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getFilePath() {
        return filePath;
    }

    public void setFilePath(String filePath) {
        this.filePath = filePath;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String scription) {
        this.description = scription;
    }
}
