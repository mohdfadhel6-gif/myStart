
/**
 *
 * Done by:
 * Mohammad Fadhel Abbas 202309079 - Hussain Ali Mirza Shamlooh 202309709
 *
 *
 */


import java.util.*;

public class Course {

    /** Data members */

    private String courseNum;
    private String courseName;
    private int credits;
    private int section;

    /** Default constructor ( no parameters ) */
    public Course() {
        this.courseNum = "";
        this.courseName = "";
        this.credits = 0;
        this.section = 0;
    }

    /** Constructor with 4 parameters */
    public Course(String courseNum, String courseName, int credits, int section) {
        this.courseNum = courseNum;
        this.courseName = courseName;
        this.credits = credits;
        this.section = section;
    }

    /** Getters */
    public String getCourseNum() {
        return courseNum;
    }

    public String getCourseName() {
        return courseName;
    }

    public int getCredits() {
        return credits;
    }

    public int getSection() {
        return section;
    }

    /** Setters */
    public void setCourseNum(String courseNum) {
        this.courseNum = courseNum;
    }

    public void setCourseName(String courseName) {
        this.courseName = courseName;
    }

    public void setCredits(int credits) {
        this.credits = credits;

    }

    public void setSection(int section) {
        this.section = section;
    }

//    @Override
//    public boolean equals(Object o) {
//        if (this == o) return true;
//        if (o == null || getClass() != o.getClass()) return false;
//        Course course = (Course) o;
//        return credits == course.credits && section == course.section && Objects.equals(courseNum, course.courseNum) && Objects.equals(courseName, course.courseName);
//    }



    /**Equal Method
     *
     * we just need to compare the CourseNum of two courses to check if they are equal or not
     * CourseNum like : ITCS214 , ITCS113
     * */
    public boolean equals(Course obj) {

        return this.courseNum.equalsIgnoreCase(obj.courseNum);

    }

    /**
     * toString Method
     */
    @Override



    public String toString() {
        return "Course{" +
                "courseNum='" + courseNum + '\'' +
                ", courseName='" + courseName + '\'' +
                ", credits=" + credits +
                ", section=" + section +
                '}';
    }
}