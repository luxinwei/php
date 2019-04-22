package com.gdlion.dpi.domain.vo;

import com.gdlion.dpi.domain.BaseEntity;
import org.hibernate.validator.constraints.Length;
import org.hibernate.validator.constraints.NotBlank;

import javax.validation.constraints.NotNull;
import javax.validation.constraints.Past;
import java.math.BigInteger;
import java.util.Date;

/**
 * 查岗记录管理
 * Created by zhang on 2018/1/7
 */
public class CheckJobRecordVO extends BaseEntity {

    private static final long serialVersionUID = 3318014384859552046L;

    @Length(message = "查岗发起人姓名长度应为1-20字符",min = 1,max = 20)
    private String user;

    @NotNull(message = "查岗单位id不能为空")
    private Long depId;

    @NotNull(message = "被检查单位id不能为空")
    private Long checkedDepId;

    @NotNull(message = "检查发起时间不能为空")
    @Past(message = "检查发起时间不合法")
    private Date startTime;

    @NotNull(message = "检查结束时间不能为空")
    private Date endTime;

    /** 查岗结果 1:合格  0:不合格*/
    @NotNull(message = "查岗结果不能为空")
    private Integer result;

    /** 查岗截图，base64码 */
    private String file;

    /** 文件名称 */
    private String fileName;

    public String getUser() {
        return user;
    }

    public void setUser(String user) {
        this.user = user;
    }

    public Long getDepId() {
        return depId;
    }

    public void setDepId(Long depId) {
        this.depId = depId;
    }

    public Long getCheckedDepId() {
        return checkedDepId;
    }

    public void setCheckedDepId(Long checkedDepId) {
        this.checkedDepId = checkedDepId;
    }

    public Date getStartTime() {
        return startTime;
    }

    public void setStartTime(Date startTime) {
        this.startTime = startTime;
    }

    public Date getEndTime() {
        return endTime;
    }

    public void setEndTime(Date endTime) {
        this.endTime = endTime;
    }

    public Integer getResult() {
        return result;
    }

    public void setResult(Integer result) {
        this.result = result;
    }

    public String getFile() {
        return file;
    }

    public void setFile(String file) {
        this.file = file;
    }

    public String getFileName() {
        return fileName;
    }

    public void setFileName(String fileName) {
        this.fileName = fileName;
    }
}
