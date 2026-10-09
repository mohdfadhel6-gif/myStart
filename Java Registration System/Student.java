
/**
 *
 * Done by:
 * Mohammad Fadhel Abbas 202309079
 *
 *
 */




import java.util.*;

public class Student {

    /** Data members */

    private long idNum;
    private String firstName;
    private String lastName;
    private char gender;
    private String email;
    private ArrayList<Course> coursesRegistered; /** ArrayList of type Course */
    private double GPA;
    private long advisorNum;

    /** Default constructor ( no parameters ) */
    public Student() {
        this(0,"","",' ',"",0.0,0); // it must be in the first line

        coursesRegistered = new ArrayList<>();

    }

    /** Constructor with 7 parameters
     to initialize the data members with the given values
     *      @param idNum
     *      @param firstName
     *     @param lastName
     *      @param gender
     *      @param email
     *      @param GPA
     *       @param advisorNum
     *
     *
     * */
    public Student(long idNum, String firstName, String lastName, char gender, String email, double GPA, long advisorNum) {
        this.idNum = idNum;
        this.firstName = firstName;
        this.lastName = lastName;
        this.gender = gender;
        this.email = email;
        this.coursesRegistered = new ArrayList<>();
        this.GPA = GPA;
        this.advisorNum = advisorNum;
    }

    /** Getters methods
     *
     *
     *
     * to return the value of
     * the student id
     * the student first name
     * the student last name
     * the student gender
     * the student email
     * the reference of the courseRegistered list.
     * the student QPA
     * the student advisorNum
     *
     *
     *
     * */
    public long getIdNum() {
        return idNum;
    }

    public String getFirstName() {
        return firstName;
    }

    public String getLastName() {
        return lastName;
    }

    public char getGender() {
        return gender;
    }

    public String getEmail() {
        return email;
    }

    public ArrayList<Course> getCoursesRegistered() {
        return coursesRegistered;
    }

    public double getGPA() {
        return GPA;
    }

    public long getAdvisorNum() {
        return advisorNum;
    }

    /** Setters
     * to initialize the value of
     *
     * the student id
     * the student first name
     * the student last name
     * the student gender
     * the student email
     * the reference of the courseRegistered list.
     * the student QPA
     * the student advisorNum
     *
     * */
    public void setIdNum(long idNum) {
        this.idNum = idNum;
    }
    public void setFirstName(String firstName) {
        this.firstName = firstName;
    }

    public void setLastName(String lastName) {
        this.lastName = lastName;
    }

    public void setGender(char gender) {
        this.gender = gender;

    }

    public void setEmail(String email) {
        this.email = email;
    }

    public void setCoursesRegistered(ArrayList<Course> coursesRegistered) {
        this.coursesRegistered = coursesRegistered;
    }

    public void setGPA(double GPA) {
        this.GPA = GPA;
    }

    public void setAdvisorNum(long advisorNum) {
        this.advisorNum = advisorNum;
    }




    /** Equal Method */
    public boolean equals(Student obj) {

        return (this.idNum == obj.idNum);
    }


//    @Override
//    public boolean equals(Object o) {
//        if (this == o) return true;
//        if (o == null || getClass() != o.getClass()) return false;
//        Student student = (Student) o;
//        return idNum == student.idNum && gender == student.gender && Double.compare(GPA, student.GPA) == 0
//                && advisorNum == student.advisorNum
//                && Objects.equals(firstName, student.firstName)
//                && Objects.equals(lastName, student.lastName)
//                && Objects.equals(email, student.email)
//                && Objects.equals(coursesRegistered, student.coursesRegistered);
//    }

    /** printCoursesRegistered method (it prints all the attributes of courseRegistered of type Course) */
    public void printCoursesRegistered() {

        if(coursesRegistered.size()==0) {
            System.out.println("Registered courses are empty !");
            return;
        }

        System.out.println("The courses registered : ");

        for (Course course : coursesRegistered) {
            int a=0;
            System.out.println("Course "+(a+1));
            System.out.println("Course name : "+course.getCourseName());
            System.out.println("Course number : "+course.getCourseNum());
            System.out.println("Credits : "+course.getCredits());
            System.out.println("Section : "+course.getSection());
            System.out.println("--------------------------------------------");

        }
    }

    /**
     *
     * it converts student class attributes to string when printing
     *
     * */

    @Override
    public String toString() {
        return "Student{" +
                "idNum=" + idNum +
                ", firstName='" + firstName + '\'' +
                ", lastName='" + lastName + '\'' +
                ", gender=" + gender +
                ", email='" + email + '\'' +
                ", GPA=" + GPA +
                ", advisorNum=" + advisorNum +
                '}';
    }
}
