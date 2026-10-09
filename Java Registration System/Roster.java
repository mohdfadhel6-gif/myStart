

/**
 *
 * Done by:
 * Mohammad Fadhel Abbas 202309079 - Hussain Ali Mirza Shamlooh 202309709
 *
 *
 */


import java.util.*;

public class Roster {

    /**
     *
     * studentList has class student attributes including coursesRegistered List
     */
    private LinkedList<Student> studentsList;
    private int size;

    /**
     *  Constructor (no parameters)
     *
     * initialize the studentList to empty and size to 0
     *
     */
    public Roster() {
        studentsList = new LinkedList<>();
        size = 0;
    }

    /**
     * Add Student
     * Using search method to find the student
     * if the search method has not returned -1 so that means that
     *  the student registered before , so no addition will happen ,
     *  else the student will be added ascending based on idNum
     *
     */
    public boolean addStudent(Student st) {

        int index = searchStudent(st.getIdNum());
        if (index != -1) {
            System.out.println("This student is already registered! ");
            return false;
        }

        else{
        int i = 0,x=0;
        while (i < size) {


            if (studentsList.get(i).getIdNum() < st.getIdNum())
                x++;

            else break;

            i++;

        }

        studentsList.add(x, st);
        size++;
        System.out.println("Student "+st.getIdNum()+" is added successfully ");
        return true;
}}



    /** Delete Student
     *
     * when user wants to delete a course , we should check that the course exists in the list or not
     * so we will use the search method
     * if the student is found then removed
     *
     * */
    public boolean deleteStudent(long idNum) {
        int index = searchStudent(idNum);
        if (index == -1) {
            System.out.println("Student with id "+idNum+" is not found ");
            return false;
        }
        studentsList.remove(index);
        size--;
        System.out.println("Student deleted successfully");
        return true;
    }

    /** Search Student
     *
     * it will search in the studentList and compare the parameter idNum with the idNums in the list
     * if the two id numbers equals , then the index of the id in the list will be returned
     * else -1 will be returned
     * */
    public int searchStudent(long idNum) {
        for(int i=0; i<size ; i++)
            if((studentsList.get(i).getIdNum())==(idNum))
                return i;

         return -1;

        }

    /** Is Empty */
    public boolean isEmpty() {
        return size == 0;
    }

    /** List Size */
    public int listSize() {
        return size;
    }

    /** Get Student
     *
     * the user will enter index as parameter
     * if the index less than 0 or more than or equal to the size , a message will be printed
     *
     * */
    public Student getStudent(int index) {
        if (index < 0 || index >= size) {
            System.out.println("This index is not valid!");
            throw new IndexOutOfBoundsException();
        }
        return studentsList.get(index);
    }

    /** Add Course
     *
     *
     * Using search method to find the student
     *     if the search method returns -1 so that means that
     *    the student is not registered before , so no addition will happen ,
     *
     *    else we will check if the courseNum of the course object parameter is in the list of CoursesRegistered or not
     *    we will use for loop to search in the CoursesRegistered list , if the course number equals another course number in the list
     *    then there will not be any addition to the course , because it is registered before
     *
     *
     *    also we will check if (totalCredits > 18 && (student.getGPA() <= 3.0) || (totalCredits > 21))
     *    we will calculate total credits of the coursesRegistered in a loop then combine it with the credits of the course object parameter
     *
     *    if no collision with the conditions then the course will be added
     *
     * */
    public boolean addCourse(Course course, long idNum) {
        int index = searchStudent(idNum);
        if (index == -1) {
            return false;
        }

        else{

        Student student = studentsList.get(index);
        int s=studentsList.get(index).getCoursesRegistered().size();
            for(int i=0 ; i<s ; i++)

 if (student.getCoursesRegistered().get(i).getCourseNum().equalsIgnoreCase(course.getCourseNum())) {
     System.out.println("The course is already registered before!");
            return false;
        }

        int totalCredits = 0;
        for(int i=0 ; i<s ; i++) {

            int credits = student.getCoursesRegistered().get(i).getCredits();
            totalCredits = totalCredits + credits;

        }

        totalCredits+=course.getCredits();



            if ((totalCredits > 18 && (student.getGPA() <= 3.0) || (totalCredits > 21))) {
                System.out.println("can't add the course , the credits are exceeds!  ");
                return false;
            }

        else{ student.getCoursesRegistered().add(course);

            System.out.println(course.getCourseNum()+" is added successfully ");

        return true;

        }
    }}

    /** Delete Course
     *
     *  Using search method to find the student
     *           if the search method returns -1 so that means that
     *          the student is not registered before , so no deletion will happen ,
     *
     *
     *          we will check also that if deletion will make a total credits < 12
     *         if so , the deletion will not happen
     *
     *         else the course will be deleted
     *
     *
     * */
    public void deleteCourse(Course course, long idNum) {
        int index = searchStudent(idNum);
        if (index == -1) {
            System.out.println("Student with id "+idNum+" is not found ");
       return;
        }
        Student student = studentsList.get(index);

if(student.getCoursesRegistered().isEmpty())
{

    System.out.println("The courses registered list is empty!");
    return;
}

        int s=studentsList.get(index).getCoursesRegistered().size();

        int totalCredits = 0;
        for(int i=0 ; i<s ; i++) {

            int credits = student.getCoursesRegistered().get(i).getCredits();
            totalCredits = totalCredits + credits;

        }

        totalCredits=totalCredits-course.getCredits();



        if(totalCredits <12 ) {
            System.out.println("Cannot delete course. Minimum 12 credit hours required.");
            return ;
        }

        for(int i=0 ; i<s ; i++)

            if (student.getCoursesRegistered().get(i).getCourseNum().equalsIgnoreCase(course.getCourseNum())) {
                student.getCoursesRegistered().remove(i);
                System.out.println(course.getCourseNum()+" is deleted successfully ");
                return;
            }

        System.out.println("You has not registered this course before , it's not found!");
         return;


    }

    /** Print Student Details
     * Using search method to find the student
     *   if the search method returns -1 so that means that
     *   the student is not registered before , so no printing will happen
     *
     * we will use .printCoursesRegistered() method which is in class student
     * we will print the object student
     * we also create toString method tho object student to enable printing it
     *
     * */
    public void printStudentDetails(long idNum) {
        int index = searchStudent(idNum);
        if (index == -1) {
            System.out.println("Student is not found!");
            return;
        }

        Student student = studentsList.get(index);

        System.out.println(student);


        student.printCoursesRegistered();
    }

    /** Print Advisor number */
    public void printAdvisor(long idNum) {
        int index = searchStudent(idNum);
        if (index == -1) {
            System.out.println("Student is not found!");
            return;
        }

        Student student = studentsList.get(index);
        System.out.println("Advisor number: " + student.getAdvisorNum());
    }
}