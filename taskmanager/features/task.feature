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
    And there is no tasks
    And there is no notifications

  Scenario: Create a simple task
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

  Scenario: Update task priority
    Given there is unassigned task named "Change priority test"
    When I change task named "Change priority test" priority to "Critical"
    Then task named "Change priority test" should have priority value equal to "Critical"

  Scenario: Delete task
    Given there is unassigned task named "Deleting test"
    When I remove task named "Deleting test"
    Then task named "Deleting test" should no longer exist

  Scenario: Assign already assigned task
    Given there is task named "Add switch language button" assigned to user named "Carl"
    When I assigned task named "Add switch language button" to user named "Sarah"
    Then task named "Add switch language button" should be assigned to user named "Sarah"

  Scenario: Change task status from TODO to IN PROGRESS
    Given there is a task named "Add switch language button" with "TODO" status
    When user named "Sarah" changes task named "Add switch language button" status to "IN PROGRESS"
    Then task named "Add switch language button" should have status "IN PROGRESS"
    And task named "Add switch language button" should be assigned to user named "Sarah"

  Scenario: Change task status from IN PROGRESS to DONE
    Given there is a task named "Add switch language button" with "IN PROGRESS" status
    When user named "Sarah" changes task named "Add switch language button" status to "DONE"
    Then task named "Add switch language button" should have status "DONE"

  Scenario: Change task status from DONE to CLOSED
    Given there is a task named "Add switch language button" with "DONE" status
    When user named "Sarah" changes task named "Add switch language button" status to "CLOSED"
    Then task named "Add switch language button" should have status "CLOSED"

  Scenario: Change task status from IN PROGRESS to TODO
    Given there is a task named "Add switch language button" with "IN PROGRESS" status
    When user named "Sarah" changes task named "Add switch language button" status to "TODO"
    Then task named "Add switch language button" should have status "TODO"
    And task named "Add switch language button" should be unassigned

  Scenario: Change task status from DONE to IN PROGRESS
    Given there is a task named "Add switch language button" with "DONE" status
    When user named "Sarah" changes task named "Add switch language button" status to "IN PROGRESS"
    Then task named "Add switch language button" should have status "IN PROGRESS"
    And task named "Add switch language button" should be assigned to user named "Sarah"

  Scenario: Change task status from CLOSED to TODO
    Given there is a task named "Add switch language button" with "CLOSED" status
    When user named "Sarah" tries to change task named "Add switch language button" status to "TODO"
    Then task named "Add switch language button" still should have status "CLOSED"
    And user named "Sarah" should see notice that changing closed task status is disallowed