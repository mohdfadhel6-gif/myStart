/**
 *
 * Done by:
 * Mohammad Fadhel Abbas 202309079 - Hussain Ali Mirza Shamlooh 202309709
 *
 *
 */




import java.util.*;

public class Registration  {
    public static void main(String[] args) {

        /**
         * initialize constructors to default
         */

        Scanner in = new Scanner(System.in);
        Roster roster=new Roster();
        Course course=new Course();
        Student student=new Student();

        /**
         * initialize id because I will use it so much so do not need to redeclare it
         */

        Long id;


        int option = 0;

        /**
         * List of services
         */

        System.out.println("Select a service number: ");
        System.out.println("1. Register student");
        System.out.println("2. Remove student");
        System.out.println("3. Add Course to Student");
        System.out.println("4. Remove Course from Student");
        System.out.println("5. Get student location in the list ");
        System.out.println("6. Print Student Advisor ");
        System.out.println("7. Print All Student Information");
        System.out.println("8. Get main information about student ");
        System.out.println("9. Get students list size ");
        System.out.println("10. Get All students based on ID ascending order ");
        System.out.println("11. Leave");


        /** While loop inside it a switch statement
         *
         * if the user enters 11 the loop will stop
         */


        while (option!=11){

            System.out.println("Select a number: ");

            /**
             *  Using try and catch to avoid errors
             *
             */

            try {


                /**
                 *  if the user enters invalid input , message will be printed to look out
                 *
                 */

                option= in.nextInt();
                if (option < 1 && option > 11) {
                    System.out.println("Invalid selection. Please enter a number between 1 and 11.");
                }


                else {



                    switch (option){

                        /**
                         *
                         * case the user wants to add a student
                         * If the user enters id that  exists before , message will be printed
                         * else the student will be added
                         */

                        case 1:
                            System.out.println("Enter the Student ID: ");
                         id= in.nextLong();
                            if(roster.searchStudent(id)==-1){

                            System.out.println("Enter the First Name: ");
                            String firstName = in.next();
                            System.out.println("Enter the Last Name: ");
                            String lastName = in.next();
                            System.out.println("Enter the Gender (M/F): ");
                            char gender = in.next().charAt(0);
                            System.out.println("Enter the Email: ");
                            String email = in.next();
                            System.out.println("Enter the GPA: ");
                            double GPA = in.nextDouble();
                            System.out.println("Enter the AdvisorNum : ");
                            long advisorNum = in.nextLong();
                            student = new Student(id, firstName, lastName, gender, email, GPA, advisorNum);
                            roster.addStudent(student);}

                            else  System.out.println("Student with id "+id+" is not found , re-select the service you want ");


                            break;

/**
 *
 * delete a student
 */
                        case 2: System.out.println("Enter Student ID to delete: ");
                            long IdNum = in.nextLong();
                            roster.deleteStudent(IdNum); break;


/**
 * case the user wants to add a new course
 *
 * if the student id was not found , then he will be asked to re-select the service again
 */
                        case 3:
                            System.out.println("Enter Student ID: ");
                            id = in.nextLong();

                            if(roster.searchStudent(id)!=-1){

                            System.out.println("Enter Course Number to add: ");
                            String courseNum = in.next();
                            System.out.println("Enter Course Name to add: ");
                            in.nextLine();
                            String courseName = in.nextLine();
                            System.out.println("Enter Course Credits: ");
                            int courseCredits = in.nextInt();
                            System.out.println("Enter Course Section: ");
                            int courseSection = in.nextInt();

                            Course c = new Course(courseNum, courseName, courseCredits, courseSection);

                            roster.addCourse(c,id);}


                            else  System.out.println("Student with id "+id+" is not found , re-select the service you want ");


                            break;

                        /**
                         *
                         * case delete a course
                         */


                        case 4:
                            System.out.println("Enter Student ID: ");
                            id = in.nextLong();
                            System.out.println("Enter Course Number to remove: ");
                            String courseNum1 = in.next();

                         String courseName1= course.getCourseName();
                         int courseCredits1 = course.getCredits();
                          int section = course.getSection();
                          Course c1 = new Course(courseNum1, courseName1, courseCredits1, section);

                            roster.deleteCourse(c1,id);
                            break;


                        /**
                         *
                         * case getting the student location in the student list
                         */

                        case 5 :   System.out.println("Enter student ID : ");
                            id = in.nextLong();
                            System.out.println("The student location is "+roster.searchStudent(id));
                            break;


                        /**
                         *
                         * case printing the advisor number
                         */

                        case 6:
                            System.out.println("Enter Student ID : ");
                            id = in.nextLong();
                             roster.printAdvisor(id);
                            break;


                        /**
                         *
                         * print the student details
                         *
                         */


                        case 7:
                            System.out.println("Enter Student ID : ");
                            id = in.nextLong();

                            roster.printStudentDetails(id);
                             break;


                        /**
                         * get the student main information without courses registered
                         *  Although we have a method to print student info , but we just want to check the getStudent method
                         */

                        case 8 :
                            System.out.println("Enter student index you want to retrieve: ");
    int ind = in.nextInt();
    student=roster.getStudent(ind);

    if(student==null) System.out.println("No student available here");
    else System.out.println(student); break;


/**
 *
 * print the list size or check if empty
 *
 */
                        case 9 :
if(roster.isEmpty()) System.out.println("the list is empty!");
    else System.out.println("The list size : "+roster.listSize());
    break;


                        /**
                         *
                         * print the students ascending order based on idNum
                         *
                         */
                        case 10:
                            if (roster.isEmpty())
                    System.out.println("No students available in the list .");
                 else {
                    System.out.println("All students:");
                    for (int i = 0; i < roster.listSize(); i++) {
                        Student st = roster.getStudent(i);
                        System.out.println(st.getFirstName() + " " + st.getLastName()+" "+st.getIdNum());
                    }
                }

    break;

                        /**
                         * leaving ...
                         */

    case 11 :
                            System.out.println("Leaving...");
                            System.exit(0);
                           break;

                        default:
                            System.out.println("Invalid selection. Please enter a number between 1 and 8.");



                    }}}
            catch (Exception e) {
                System.out.println("Invalid input!");
break;
            }



    }}}




