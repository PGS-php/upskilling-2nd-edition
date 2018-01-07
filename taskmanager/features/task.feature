# language: en
Feature: Task management
  In order to efficiently manage tasks
  As a user
  I want to create, follow up and assign tasks in team

  Background:
    Given there are follow users:
      | Name  |
      | Sarah |
      | Carl  |

  Scenario: Create a simple task
    Given there is no tasks
    When I create a task named "Add switch language button"
    Then there should be "1" tasks with "TODO" status
    And task should have create date
    And task should have update date

  Scenario: Assign unassigned task
    Given there is unassigned task named "Add switch language button"
    When I assigned task named "Add switch language button" to user named "Carl"
    Then task named "Add switch language button" should be assigned to user named "Carl"

  Scenario: Assign already assigned task
    Given there is task named "Add switch language button" assigned to user named "Carl"
    When I assigned task named "Add switch language button" to user named "Sarah"
    Then task named "Add switch language button" should be assigned to user named "Sarah"
