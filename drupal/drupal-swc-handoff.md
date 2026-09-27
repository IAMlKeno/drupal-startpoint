Below is the complete, copy-paste-ready Markdown document. You can save it as **`SWC_Drupal_Claude_Handoff.md`**.

````markdown
# Squat With Confidence — Drupal Handoff Specification

> **Purpose:** This document is the implementation handoff for Claude/Coding Agent to build the Drupal application for Squat With Confidence (SWC).
>
> **Primary objective:** Build a clean, maintainable coaching application around the free Squatober 2026 experience that can naturally convert engaged athletes into paid coaching relationships.

---

# 1. Project Overview

Squat With Confidence (SWC) is building a coaching/training application around **Squatober 2026**.

The business goal is:

> Provide a genuinely useful, free Squatober experience that demonstrates SWC's coaching expertise and converts engaged athletes into paid coaching relationships.

**Important:** SWC does not own Squatober. Squatober is an existing community/event associated with Sorinex and collaborators. SWC is participating in and building an experience around the existing Squatober community.

## Domains

### Public Marketing Site

```text
https://squatwithconfidence.ca
````

The public website is a Next.js application.

### Drupal Application

```text
https://swc.squatwithconfidence.ca
```

Drupal will provide the authenticated application experience and coaching backend.

---

# 2. Architecture Decision

Use a **hybrid architecture**.

```text
                    squatwithconfidence.ca
                         Next.js
                    Public / Marketing
                           |
                           | CTA
                           v
                  swc.squatwithconfidence.ca
                         Drupal 11
              Authenticated Application / Backend
                           |
        +------------------+------------------+
        |                  |                  |
     Athletes           Coaches           Admins
        |                  |
     Training          Coaching
     Challenges        Feedback
     Progress          Programming
```

## Next.js Responsibilities

Use Next.js for:

* Homepage
* About
* Coaching
* Programs
* Squatober marketing page
* Sales/landing pages
* Contact
* Public SEO content
* Marketing CTAs

Example CTA:

```text
Join Squatober for FREE
```

which directs users to:

```text
https://swc.squatwithconfidence.ca/register
```

## Drupal Responsibilities

Use Drupal for:

* Authentication
* Athlete accounts
* Athlete profiles
* Social login
* Challenge enrollment
* Workout delivery
* Workout logging
* Check-ins
* Video submissions
* Progress
* Coach dashboards
* Coach feedback
* Coaching relationships
* Programs
* Permissions
* Application/business workflows

Drupal should be the **source of truth for authenticated application data**.

---

# 3. Existing Repositories

## Drupal Repository

```text
https://github.com/IAMlKeno/drupal-startpoint/tree/swc
```

Branch:

```text
swc
```

This is a Drupal 11 start-point repository.

## Next.js Repository

```text
https://github.com/IAMlKeno/React-Landing-Page-Template/tree/swc-claude-nextify
```

Branch:

```text
swc-claude-nextify
```

Do not unnecessarily modify the Next.js application as part of the initial Drupal implementation.

---

# 4. Important Terminology

Use these terms consistently throughout the implementation.

| Term                  | Meaning                                     |
| --------------------- | ------------------------------------------- |
| Athlete               | Person participating in training/challenges |
| Coach                 | Person providing coaching                   |
| Challenge             | Time-bound community/training event         |
| Squatober             | Existing Squatober event/community          |
| Enrollment            | An athlete's participation in a challenge   |
| Exercise              | Reusable movement/exercise definition       |
| Workout               | Prescribed training                         |
| Workout Session       | What an athlete actually performed          |
| Check-in              | Athlete engagement/recovery/coaching record |
| Video Submission      | Training video submitted for review         |
| Program               | Structured training/coaching product        |
| Coaching Relationship | Relationship between Athlete and Coach      |

## Terminology Rules

Use:

```text
Athlete
```

instead of:

```text
Participant
```

Do not call the event:

```text
Squattober
```

The correct spelling is:

```text
Squatober
```

Do not create a separate `Client` entity. A client is represented by a Coaching Relationship.

---

# 5. Core Domain Model

The application should model six major domains:

1. Identity
2. Training
3. Challenges
4. Engagement
5. Coaching
6. Progress

Conceptually:

```text
USER
 ├── ATHLETE
 └── COACH

ATHLETE
 ├── CHALLENGE ENROLLMENT
 │      └── CHALLENGE
 │             └── WORKOUT
 │                   ├── WORKOUT EXERCISE
 │                   │       └── EXERCISE
 │                   └── WORKOUT SESSION
 │
 ├── CHECK-IN
 ├── VIDEO SUBMISSION
 ├── PROGRESS (derived)
 │
 └── COACHING RELATIONSHIP
          ├── COACH
          └── PROGRAM
```

---

# 6. Drupal User / Athlete Model

Use Drupal's native **User entity**.

Do **not** create a custom Athlete entity simply to represent a person.

An Athlete is a Drupal User with the Athlete role.

## Roles

Initially use:

```text
Anonymous
Authenticated
Athlete
Coach
Administrator
```

Avoid creating unnecessary roles until a concrete permission requirement exists.

---

# 7. Athlete Profile

Add athlete-specific fields to the Drupal User entity.

Suggested fields:

* First name
* Last name
* Profile image
* Training experience
* Squat experience
* Current squat 1RM
* Squat goal
* Training frequency
* Equipment/access

## Registration Philosophy

Registration should be low-friction.

Do **not** force a long intake questionnaire before joining free Squatober.

Preferred flow:

```text
Create account
      ↓
Join Squatober
      ↓
Start using application
      ↓
Collect additional profile information progressively
```

The goal is to minimize registration friction.

---

# 8. Authentication / Social Login

Social login is required from the beginning.

Target providers:

* Google
* Apple
* Facebook
* Additional providers later if useful

Use established Drupal authentication modules rather than implementing OAuth manually.

Potential implementation direction:

* OpenID Connect ecosystem
* Social Auth provider modules

Relevant considerations:

* OpenID Connect supports Drupal 11.
* Social Auth Google supports Drupal 11.
* Social Auth Apple Sign-In supports Drupal 11.
* Facebook should use the best-maintained Drupal-compatible implementation available at implementation time.

Before installing a module, verify its current Drupal 11 compatibility and maintenance status.

---

# 9. Critical Authentication Requirement: Account Linking

Different social providers must be able to map back to the same Drupal User.

For example:

```text
Google login
      |
      v
Existing Drupal User
      ^
      |
Apple login
```

Do not create duplicate Athlete accounts simply because the athlete uses a different login provider.

The implementation must account for:

* Existing email/password accounts
* Google login
* Apple login
* Facebook login
* Provider identity linking
* Duplicate-account prevention
* Account recovery

## Security

OAuth/social credentials and secrets must never be committed to Git.

Use environment variables/configuration management.

---

# 10. Challenge Entity

Create a reusable Challenge entity/content model.

Example:

```text
Squatober 2026
```

Suggested fields:

* Title
* Start date
* End date
* Status
* Hero image
* Description
* Rules
* FAQs
* Challenge content

The application should **not hardcode Squatober into the data model**.

Future challenges should be possible:

```text
Challenge
 ├── Squatober 2026
 ├── Winter Strength Challenge
 └── Future Challenge
```

Squatober is simply one Challenge instance.

---

# 11. Challenge Enrollment

Create a dedicated Challenge Enrollment entity.

Do **not** simply add a challenge reference to the User entity.

An enrollment represents:

> One Athlete participating in one specific Challenge.

Suggested fields:

* Athlete/User reference
* Challenge reference
* Joined date
* Status
* Starting squat 1RM
* Current squat 1RM
* Completion date where appropriate

Suggested statuses:

```text
Registered
Active
Completed
Abandoned
```

Potential future status:

```text
Paused
```

Relationship:

```text
Athlete
   |
   +---- Challenge Enrollment ----> Challenge
```

This allows the same Athlete to participate in multiple challenges.

---

# 12. Enrollment Business Rules

The implementation should consider the following:

### Duplicate Enrollment

An Athlete should not accidentally create multiple active enrollments for the same Challenge.

Prefer enforcing an appropriate uniqueness/business rule.

### Free Participation

Squatober registration through SWC is free.

There should be:

```text
No payment requirement
```

for initial Squatober enrollment.

### Enrollment Lifecycle

Suggested lifecycle:

```text
Registered
    ↓
Active
    ↓
Completed
```

or:

```text
Registered
    ↓
Active
    ↓
Abandoned
```

Do not delete historical enrollment records merely because an athlete stops participating.

---

# 13. Exercise Entity

Create a reusable Exercise entity.

Suggested fields:

* Name/title
* Category
* Instructions
* Video/media
* Primary muscle/group where useful
* Equipment

Examples:

```text
Back Squat
Front Squat
Pause Squat
Tempo Squat
Bulgarian Split Squat
```

Exercises must be reusable across multiple workouts and programs.

Do not duplicate exercise definitions inside individual workouts.

---

# 14. Workout Model

A Workout represents **prescribed training**.

It does NOT represent what the athlete actually performed.

Suggested fields:

* Challenge reference and/or Program reference
* Day/order
* Workout title
* Description
* Instructions

A Workout contains a sequence of Workout Exercises.

Recommended conceptual structure:

```text
Workout
   |
   +-- Workout Exercise
   |      +-- Exercise
   |      +-- Sets
   |      +-- Reps
   |      +-- Intensity
   |      +-- RPE
   |      +-- Rest
   |      +-- Notes
   |
   +-- Workout Exercise
          ...
```

---

# 15. Workout Exercise

Workout Exercise is the bridge between a reusable Exercise and a specific prescription.

For example:

```text
Exercise:
Back Squat
```

may appear in one workout as:

```text
5 x 5 @ 75%
```

and another as:

```text
3 x 3 @ 85%
```

Therefore, prescription data belongs to Workout Exercise, not Exercise.

Possible fields:

* Exercise reference
* Order
* Sets
* Reps
* Weight/intensity
* Intensity type
* Percentage
* RPE
* Rest period
* Tempo
* Notes
* Optional athlete instructions

Choose the Drupal data structure that gives the best maintainability.

Paragraphs, custom entities, or another appropriate structured approach are acceptable.

Do not over-engineer this.

---

# 16. Workout Session

A Workout Session represents what an Athlete actually performed.

This distinction is critical:

```text
WORKOUT
= prescribed training

WORKOUT SESSION
= actual training performed
```

A Workout Session should contain:

* Athlete
* Workout
* Date/time
* Completion state
* Actual sets
* Actual reps
* Actual weight
* RPE
* Notes

Potentially model actual sets as a child structure if needed:

```text
Workout Session
   |
   +-- Session Set
          +-- Reps
          +-- Weight
          +-- RPE
          +-- Notes
```

Do not overwrite the Workout prescription when an Athlete performs something differently.

Example:

```text
Prescribed:
5 x 5 @ 75%

Actual:
5 x 5 @ 315 lb
RPE 8
```

This distinction enables future analytics and progress tracking.

---

# 17. Check-ins

Create a first-class Check-in entity.

Purpose:

1. Athlete engagement
2. Coaching insight
3. Retention
4. Sales funnel signal

Suggested fields:

* Athlete
* Challenge Enrollment
* Date
* Energy
* Recovery
* Confidence
* Squat difficulty
* Athlete notes
* Coach feedback
* Review status
* Reviewed date

Potential statuses:

```text
Pending
Reviewed
Needs Follow-up
```

Check-ins should be useful to both Athlete and Coach.

---

# 18. Video Submissions

Create a separate Video Submission entity.

Do **not** make video submissions merely a field on Workout Session.

Suggested fields:

* Athlete
* Workout Session
* Video/media
* Submitted date
* Status
* Coach
* Coach feedback
* Reviewed date

Suggested statuses:

```text
Pending
Reviewed
Needs Follow-up
```

Workflow:

```text
Athlete performs squat
        ↓
Completes Workout Session
        ↓
Uploads squat video
        ↓
Coach reviews
        ↓
Coach gives feedback
        ↓
Athlete experiences SWC coaching
        ↓
Potential coaching assessment
```

This is an important part of the free-to-paid funnel.

---

# 19. Video / Media Security

Athlete videos may contain private personal information and must not be publicly accessible by default.

Ensure:

* Uploads use appropriate private file handling
* Athletes can view their own submissions
* Assigned Coaches can view submissions they are authorized to review
* Unrelated Athletes cannot view them
* Anonymous users cannot access them
* Direct file URLs cannot bypass access controls where inappropriate

Review Drupal's private file configuration before implementing the submission workflow.

---

# 20. Progress

Do **not** create a giant Progress entity that duplicates all training information.

Progress should primarily be derived from source records:

* Workout Sessions
* Check-ins
* Performance records / PRs
* Starting/current squat information
* Other legitimate performance data

Dashboard metrics may include:

* Workouts completed
* Completion percentage
* Current streak
* Total sessions
* Starting squat
* Current squat
* Estimated 1RM
* Training volume
* PRs

Avoid storing redundant derived values unless there is a clear performance/caching reason.

---

# 21. Progress Calculations

Progress calculations should live in application/business logic rather than being scattered throughout templates.

Consider a service such as:

```text
ProgressService
```

Possible responsibilities:

```text
calculateChallengeProgress()
calculateWorkoutCompletion()
calculateCurrentStreak()
calculateEstimatedOneRepMax()
calculateTrainingVolume()
calculatePerformanceSummary()
```

Keep calculation logic testable.

Do not duplicate the same formulas in multiple controllers/templates.

---

# 22. Coaching Relationship

Create a Coaching Relationship entity.

This represents the relationship between an Athlete and Coach.

Suggested fields:

* Athlete
* Coach
* Start date
* Status
* Goals
* Program reference
* Notes

Suggested statuses:

```text
Prospect
Assessment
Active
Paused
Completed
```

Do **not** create a separate Client entity.

An Athlete becomes a coaching client through the Coaching Relationship.

Example:

```text
Free Squatober Athlete
        ↓
Engagement
        ↓
Coaching Assessment
        ↓
Coaching Relationship
        ↓
Paid Program
```

---

# 23. Programs

Programs are different from Challenges.

## Challenge

A time-bound community/event experience.

Example:

```text
Squatober 2026
```

## Program

A structured training/coaching product.

Examples:

```text
Squat With Confidence
Bench With Confidence
Beginner Powerlifting
Strength for Busy Professionals
Six-Week Transformation
```

An Athlete may move through:

```text
Squatober
   ↓
Assessment
   ↓
Paid Program
   ↓
Long-term Coaching
```

Create a reusable Program model.

Do not hardcode the existing programs into application logic.

---

# 24. Athlete Views

Use Drupal Views heavily.

Do not build custom React tables for basic data-oriented screens.

Suggested Athlete Views:

## My Challenges

Shows:

* Challenge
* Status
* Start date
* End date
* Progress

## My Workouts

Shows:

* Workout
* Day/date
* Completion status

## My Progress

Shows relevant progress metrics.

## My Check-ins

Shows submitted check-ins.

## My Video Submissions

Shows submitted videos and review status.

---

# 25. Coach Views

Suggested Coach Views:

## Athlete List

Columns:

```text
Athlete | Challenge | Progress | Last Active
```

## Pending Video Reviews

Shows videos awaiting coach review.

## Check-ins Needing Attention

Shows:

* Athlete
* Date
* Status
* Notes
* Follow-up state

## Active Coaching Relationships

Shows active Athlete/Coach relationships.

## Program Enrollments

Shows Athletes enrolled in programs.

## Challenge Participation

Shows challenge enrollment and status.

---

# 26. Athlete Dashboard

The Athlete dashboard should be the main authenticated landing page.

Conceptually:

```text
------------------------------------------------
Welcome, Athlete
------------------------------------------------

Squatober 2026
[████████████░░░] 80% complete

Today's Workout
----------------
Back Squat
5 x 5 @ prescribed intensity

[Start Workout]

------------------------------------------------

Recent Progress
- Current squat
- Starting squat
- Estimated 1RM
- Workouts completed
- Current streak

------------------------------------------------

Check-in
How are you feeling today?

[Complete Check-in]

------------------------------------------------

Coach Feedback
Latest video/check-in feedback
------------------------------------------------

Coaching
Want personalized coaching?

[Book an Assessment]
------------------------------------------------
```

Do not overbuild the dashboard during the MVP.

---

# 27. Coach Dashboard

The Coach dashboard should prioritize actions rather than generic statistics.

Conceptually:

```text
Coach Dashboard

Needs Attention
----------------
5 Video Reviews
3 Check-ins
2 Follow-ups

Athletes
----------------
Active athletes
Recent activity

Coaching
----------------
Prospects
Assessments
Active relationships
```

The primary objective is helping the Coach quickly identify who needs attention.

---

# 28. Permissions

Security must use least privilege.

## Athlete

Should be able to:

* View/edit own profile
* View own enrollments
* View assigned workouts
* Create Workout Sessions
* Create Check-ins
* Upload own videos
* View own progress
* View own feedback

Should NOT be able to:

* View other Athletes
* Modify another Athlete's records
* View private Coach notes
* Modify prescribed programming unless explicitly permitted
* Access administrative functionality

## Coach

Should be able to:

* View assigned Athletes
* View Athlete progress
* Review Video Submissions
* Provide feedback
* Review Check-ins
* Manage programming where appropriate
* Manage Coaching Relationships where appropriate

Coach access should not automatically equal unrestricted Drupal administration.

## Administrator

Full administrative access.

---

# 29. Ownership / Access Model

Every user-owned record should have an explicit ownership relationship.

Examples:

```text
Workout Session → Athlete
Check-in        → Athlete
Video Submission → Athlete
Challenge Enrollment → Athlete
```

Coach access should be determined by an appropriate relationship rather than simply allowing every Coach to access every Athlete record.

Avoid implementing permissions as:

```text
if user has Coach role:
    allow everything
```

unless the specific data is genuinely intended to be globally visible to all Coaches.

---

# 30. Application Routes / UX

The authenticated application can initially be Drupal-rendered.

Suggested routes:

```text
/login
/register
/dashboard
/workouts
/progress
/check-ins
/submissions
/profile

/coach
/coach/athletes
/coach/submissions
/coach/check-ins
/coach/programs
/coach/challenges
```

These are conceptual routes.

Use Drupal routing, Views, forms, and entities appropriately rather than creating unnecessary custom controllers.

---

# 31. Next.js / Drupal Boundary

The public Next.js site should remain focused on marketing and sales.

Drupal should remain focused on authenticated application functionality.

## Next.js

```text
/
 /about
 /coaching
 /programs
 /squatober
 /contact
```

## Drupal

```text
/login
/register
/dashboard
/workouts
/progress
/check-ins
/submissions
/profile
/coach
...
```

The initial authenticated UI should be Drupal-rendered.

Do not recreate Drupal CRUD/data interfaces in React unless a specific UX requirement justifies it.

---

# 32. API / JSON:API

Drupal should be the source of truth for application data.

JSON:API can expose data when the Next.js application or future clients need it.

Potential future use cases:

* Public Squatober data
* Public program data
* Custom React dashboards
* Mobile application
* External integrations
* Marketing statistics

Do not build a complete custom API layer unnecessarily.

Prefer Drupal's existing API capabilities where appropriate.

---

# 33. Free-to-Paid Funnel

The Drupal application is not merely a workout tracker.

It is part of the SWC coaching funnel.

The intended lifecycle is:

```text
PUBLIC WEBSITE
      ↓
Join Squatober — FREE
      ↓
ATHLETE ACCOUNT
      ↓
SQUATOBER ENROLLMENT
      ↓
WORKOUT PARTICIPATION
      ↓
CHECK-INS
      ↓
VIDEO SUBMISSIONS
      ↓
COACH FEEDBACK
      ↓
ATHLETE SEES COACHING VALUE
      ↓
ASSESSMENT
      ↓
COACHING RELATIONSHIP
      ↓
PAID PROGRAM / COACHING
```

Build the architecture so this funnel is measurable and extensible.

## Important

Do not make the free Squatober experience feel like a crippled trial.

The Athlete should receive real value.

The conversion should come from demonstrated coaching expertise and engagement.

---

# 34. Conversion Tracking

Eventually track useful funnel events such as:

```text
Registered
Joined Squatober
Completed First Workout
Completed X Workouts
Submitted Check-in
Submitted Video
Received Coach Feedback
Requested Assessment
Started Assessment
Became Prospect
Started Coaching Relationship
Joined Program
```

Do not over-engineer analytics during Phase 1.

The data model should simply avoid making future tracking impossible.

---

# 35. Notifications

Notifications can be implemented after the core domain model is stable.

Potential notifications:

* Challenge registration confirmation
* Workout reminders
* Check-in reminders
* Coach feedback available
* Video review completed
* Assessment invitation
* Program onboarding

Avoid introducing a large notification framework before the basic workflows work.

---

# 36. Custom SWC Module

Create a custom module for application-specific business logic.

Suggested structure:

```text
swc/
  swc.info.yml
  swc.module
  swc.install
  swc.permissions.yml
  swc.routing.yml
  swc.services.yml

  src/
    Entity/
    Controller/
    Form/
    Plugin/
    Service/

  templates/
```

The exact structure can evolve based on the implementation.

## Custom code should handle

* Enrollment business rules
* Workout completion logic
* Progress calculations
* Dashboard-specific business logic
* Coaching workflow logic
* Notifications
* Funnel/conversion tracking
* Specialized integrations

## Do not custom-code

Things Drupal configuration can already provide:

* Basic content types
* Basic fields
* Basic entity references
* Basic CRUD
* Basic lists
* Basic filtering
* Basic Views
* Basic administrative screens
* Basic media handling

Prefer configuration before custom PHP.

---

# 37. Module Philosophy

Keep the MVP lean.

Likely core dependencies:

* Drupal 11
* User
* Views
* Media
* File
* JSON:API
* REST only where actually required
* OpenID Connect / Social Auth provider modules

Potential later:

* Admin Toolbar
* Token
* Pathauto
* Webform
* Scheduler
* Search API

Do not install modules simply because they might be useful later.

Every dependency should have a clear purpose.

Before adding a contributed module:

1. Verify Drupal 11 compatibility.
2. Check maintenance status.
3. Check security coverage.
4. Check whether Drupal core already provides the functionality.
5. Consider whether a small amount of custom SWC code is cleaner.

---

# 38. Data Ownership Rules

These rules are important.

## Exercise

Owns the reusable exercise definition.

## Workout

Owns the prescribed training.

## Workout Exercise

Owns exercise-specific prescription within a Workout.

## Workout Session

Owns actual Athlete performance.

## Challenge

Owns challenge definition.

## Challenge Enrollment

Owns an Athlete's participation in a Challenge.

## Check-in

Owns Athlete engagement/check-in information.

## Video Submission

Owns a submitted training video and review state.

## Progress

Is primarily derived.

## Coaching Relationship

Owns the Athlete/Coach relationship.

## Program

Owns the structured training/coaching product.

Avoid duplicating the same information across multiple entities.

---

# 39. Entity Relationship Summary

A simplified model:

```text
                         USER
                          |
              +-----------+-----------+
              |                       |
           ATHLETE                   COACH
              |
      +-------+--------+
      |                |
      v                v
CHALLENGE           WORKOUT
ENROLLMENT             |
      |                |
      v                v
 CHALLENGE       WORKOUT EXERCISE
                       |
                       v
                    EXERCISE

ATHLETE
   |
   +---- WORKOUT SESSION
   |
   +---- CHECK-IN
   |
   +---- VIDEO SUBMISSION
   |
   +---- COACHING RELATIONSHIP
                    |
             +------+------+
             |             |
           COACH         PROGRAM
```

---

# 40. Phase 1 — Identity + Squatober

Implement:

* Drupal 11 foundation
* Athlete role
* Coach role
* Authentication
* Google login
* Apple login
* Facebook login if technically appropriate
* Account linking
* Athlete profile
* Challenge
* Challenge Enrollment
* Squatober 2026 data

## Deliverable

An Athlete can:

```text
Register/login
      ↓
Join Squatober
      ↓
See Squatober enrollment
      ↓
Access application
```

---

# 41. Phase 2 — Training

Implement:

* Exercise
* Workout
* Workout Exercise
* Workout Session
* Athlete dashboard
* Workout completion
* Basic progress

## Deliverable

```text
Athlete
   ↓
Views workout
   ↓
Performs workout
   ↓
Logs actual performance
   ↓
Sees progress
```

---

# 42. Phase 3 — Coaching Engagement

Implement:

* Check-ins
* Video submissions
* Coach dashboard
* Video review workflow
* Coach feedback
* Athlete feedback display

## Deliverable

```text
Athlete
   ↓
Check-in / video
   ↓
Coach reviews
   ↓
Coach feedback
   ↓
Athlete sees feedback
```

---

# 43. Phase 4 — Conversion

Implement:

* Coaching Relationship
* Assessment workflow
* Program
* Coaching CTA
* Prospect tracking
* Conversion tracking

## Deliverable

```text
Free Athlete
   ↓
Engaged Athlete
   ↓
Assessment
   ↓
Prospect
   ↓
Active Coaching Relationship
   ↓
Paid Program
```

---

# 44. MVP Priorities

When forced to choose, prioritize:

1. Authentication
2. Athlete registration
3. Squatober enrollment
4. Workout delivery
5. Workout logging
6. Athlete dashboard
7. Check-ins
8. Video submissions
9. Coach review
10. Conversion workflow

Do not spend MVP time building:

* Complex analytics
* Mobile applications
* Custom React dashboards
* Advanced social features
* Elaborate notification systems
* Program marketplaces
* Unnecessary API abstractions

---

# 45. Non-Functional Requirements

## Security

* Follow Drupal security best practices.
* Use least-privilege permissions.
* Athlete data must not be publicly accessible by default.
* Video uploads must be access-controlled.
* Coach notes must remain private.
* Never commit OAuth/API secrets.
* Use environment configuration for secrets.
* Protect forms against CSRF and other standard Drupal concerns.
* Validate all user-submitted data.
* Do not expose sensitive data through JSON:API accidentally.

## Maintainability

Prefer:

```text
Drupal configuration
        >
Custom SWC module
        >
Custom frontend
```

when the simpler option satisfies the requirement.

## Extensibility

The architecture must support:

* Multiple challenges
* Multiple programs
* Multiple coaches
* Multiple athletes per coach
* Athletes participating in multiple challenges
* Athletes moving from free challenges to paid programs
* Future mobile/API consumers

---

# 46. Configuration Management

Drupal configuration should be exportable and committed to the repository where appropriate.

Use Drupal configuration management rather than manually configuring production.

The implementation should support:

```text
Development
    ↓
Configuration export
    ↓
Repository
    ↓
Production configuration import
```

Do not commit environment-specific secrets.

---

# 47. Environment Configuration

Use environment variables for things such as:

* Database credentials
* OAuth client IDs
* OAuth client secrets
* API keys
* External service credentials
* Environment-specific URLs where appropriate

Do not put secrets directly into:

* PHP source
* YAML committed to Git
* JavaScript
* configuration exports where secrets would be exposed

Inspect the existing repository conventions before introducing a new environment configuration approach.

---

# 48. Local Development

Before making changes, inspect the existing:

```text
compose.yaml
```

and determine how Drupal is currently intended to run locally.

Do not replace the existing development environment unless necessary.

Verify:

```text
Drupal version
PHP version
Database version
Installed modules
Configuration structure
Composer dependencies
```

before beginning implementation.

---

# 49. Existing Repository Inspection

Before writing substantial code, Claude must inspect:

1. Repository structure
2. Git branch
3. Drupal version
4. Composer dependencies
5. Existing modules
6. Existing themes
7. Existing configuration
8. Existing custom modules
9. Existing Docker/Compose setup
10. Existing environment configuration
11. Existing README/instructions

Do not assume the repository is empty.

---

# 50. Implementation Strategy for Claude

Before writing substantial code:

### Step 1

Inspect the repository.

### Step 2

Identify what already exists.

### Step 3

Compare the existing architecture against this specification.

### Step 4

Identify conflicts or missing pieces.

### Step 5

Implement the smallest clean solution.

### Step 6

Run tests/validation.

### Step 7

Document changes.

Do not immediately start creating dozens of files.

---

# 51. Architectural Conflict Rule

If the existing repository contains an architectural decision that conflicts materially with this specification:

1. Identify the conflict.
2. Explain why it matters.
3. Recommend a solution.
4. Only then make the change.

Do not silently replace major architectural decisions.

Minor implementation decisions can be made autonomously.

---

# 52. Definition of Done — Authentication

The authentication implementation is complete when:

* Athlete can register
* Athlete can log in with email/password
* Athlete can use Google
* Athlete can use Apple
* Facebook login is available if the selected implementation supports it appropriately
* Existing accounts can be linked to social identities
* Duplicate accounts are prevented/handled appropriately
* OAuth secrets are not committed
* Logout works
* Password recovery works where applicable

---

# 53. Definition of Done — Squatober

The Squatober implementation is complete when:

* Squatober 2026 exists as a Challenge
* Challenge has start/end dates
* Challenge content can be managed
* Athlete can join for free
* Enrollment is stored independently from User
* Duplicate enrollment is handled
* Athlete can view enrollment
* Athlete can see challenge status
* Challenge data is not hardcoded into custom PHP

---

# 54. Definition of Done — Training

The training implementation is complete when:

* Exercises exist
* Exercises can be reused
* Workouts reference Exercises
* Workout Exercises contain prescription data
* Workout prescriptions are distinct from actual sessions
* Athlete can view assigned workouts
* Athlete can log a Workout Session
* Actual sets/reps/weight/RPE can be recorded
* Prescription remains unchanged after session completion
* Basic progress reflects actual sessions

---

# 55. Definition of Done — Coaching

The coaching implementation is complete when:

* Athlete can submit a Check-in
* Athlete can submit a squat video
* Coach can see pending submissions
* Coach can review a video
* Coach can provide feedback
* Athlete can see feedback
* Coach can see relevant Athlete progress
* Athlete cannot see private Coach notes
* Unassigned Coaches cannot automatically access unrelated private data

---

# 56. Definition of Done — Conversion

The conversion implementation is complete when:

* Athlete can become a prospect
* Assessment can be initiated
* Assessment state can be tracked
* Coaching Relationship can be created
* Coach can be assigned
* Program can be associated
* Relationship lifecycle can be tracked
* Funnel events can be extended later

---

# 57. Testing Expectations

At minimum, test the following.

## Authentication

* Normal registration
* Normal login
* Google login
* Apple login
* Facebook login where implemented
* Account linking
* Duplicate account scenarios
* Logout
* Password reset

## Permissions

Test:

```text
Anonymous
Athlete
Coach
Administrator
```

Verify users cannot access records they should not be able to access.

## Challenge

Test:

* Create Challenge
* Enroll Athlete
* Duplicate enrollment
* View enrollment
* Change enrollment status
* Complete enrollment
* Abandon enrollment

## Training

Test:

* Create Exercise
* Create Workout
* Add Workout Exercise
* View Workout
* Create Workout Session
* Record actual performance
* Confirm prescription remains unchanged
* Confirm progress reflects actual sessions

## Coaching

Test:

* Submit Check-in
* Submit Video
* Coach sees pending item
* Coach reviews item
* Coach provides feedback
* Athlete sees feedback
* Unauthorized Coach access is denied

## Conversion

Test:

* Athlete becomes Prospect
* Assessment starts
* Coaching Relationship created
* Coach assigned
* Program associated

---

# 58. Automated Tests

Where practical, add automated tests for business-critical logic.

Especially consider tests for:

* Enrollment uniqueness
* Enrollment state transitions
* Permission/access rules
* Progress calculations
* Workout completion
* Coaching relationship states
* Account-linking logic

Do not create tests merely for trivial Drupal configuration.

Focus automated tests on business rules that could cause real problems.

---

# 59. Performance Considerations

The MVP does not need premature optimization.

However:

* Avoid N+1 entity loading where practical.
* Use Views appropriately.
* Avoid recalculating expensive progress data repeatedly if unnecessary.
* Consider caching for expensive derived metrics later.
* Avoid loading entire Athlete datasets into memory.
* Keep dashboard queries targeted.

Optimize based on actual bottlenecks rather than speculation.

---

# 60. UI / Branding

The authenticated application should feel like **Squat With Confidence**, not an untouched Drupal installation.

However, do not build a large custom React frontend solely for branding.

Use an appropriate Drupal theme/template strategy.

Prioritize:

* Clear navigation
* Mobile-friendly layout
* Strong calls to action
* Easy workout logging
* Easy check-in submission
* Easy video submission
* Clear coach feedback
* Clear progress visualization

The application should feel simple and focused.

---

# 61. Mobile Experience

The initial application can be responsive web rather than a native mobile app.

Prioritize mobile usability because Athletes will likely use the application:

* At the gym
* Between sets
* On mobile browsers
* While recording/submitting videos

Important mobile workflows:

```text
Open today's workout
       ↓
Log sets
       ↓
Complete workout
```

and:

```text
Upload video
       ↓
Submit
       ↓
Receive feedback
```

Avoid desktop-only workflows.

---

# 62. Future Mobile Application

Do not build a mobile app during MVP.

However, keep the domain model/API architecture compatible with a future mobile client.

Potential future architecture:

```text
                 Drupal
              Source of Truth
                    |
          +---------+---------+
          |                   |
       Web App            Mobile App
```

JSON:API or another well-defined API can support this later.

---

# 63. Future Payments

Payments are not required for initial free Squatober enrollment.

Paid programs/coaching will eventually require payment integration.

Do not introduce payment processing into the core Challenge Enrollment model.

Keep:

```text
Challenge
```

and:

```text
Program / Coaching Relationship
```

conceptually separate.

This will make future payment integration cleaner.

---

# 64. Future Email / CRM Integration

The system may eventually integrate with email marketing/CRM tools.

Potential events:

```text
New Athlete
Joined Squatober
Inactive Athlete
Completed Challenge
Requested Assessment
Became Prospect
Started Coaching
```

Do not add a CRM dependency during the MVP unless required.

Design the application so these events can be integrated later.

---

# 65. Business Funnel — North Star

The architecture ultimately supports this:

```text
                SQUAT WITH CONFIDENCE
                         |
             +-----------+-----------+
             |                       |
           FREE                    PAID
             |                       |
        Squatober                Coaching
             |                       |
          Athlete                Program
             |                       |
       Engagement             Relationship
             |
      Coach Exposure
             |
        Assessment
             |
       Paid Coaching
```

The technology should support this business flow without artificially restricting the free experience.

---

# 66. Initial Entity Map

Implement approximately:

```text
Drupal User
   |
   +-- Athlete role
   |
   +-- Coach role
   |
   +-- Athlete profile fields
   |
   +-- Challenge Enrollment
   |       |
   |       +---- Challenge
   |
   +-- Workout Session
   |       |
   |       +---- Workout
   |
   +-- Check-in
   |
   +-- Video Submission
   |
   +-- Coaching Relationship
           |
           +---- Coach/User
           |
           +---- Program


Challenge
   |
   +---- Workout
          |
          +---- Workout Exercise
                  |
                  +---- Exercise
```

---

# 67. Suggested Drupal Implementation Choices

These are recommendations, not absolute requirements.

Prefer Drupal's native capabilities where possible.

### User

Native Drupal User entity.

### Challenge

Could be a content type or custom content entity depending on requirements.

### Enrollment

Likely a custom content/entity model because it represents a meaningful relationship with its own fields and lifecycle.

### Exercise

Could be a content type or custom content entity.

### Workout

Could be a content type or custom entity.

### Workout Exercise

Use structured child data such as Paragraphs or an appropriate custom entity if the prescription complexity requires it.

### Workout Session

Likely a custom entity because it represents transactional/performance data.

### Check-in

Likely a custom content/entity model.

### Video Submission

Likely a custom entity because of ownership, review workflow, media, and permissions.

### Coaching Relationship

Likely a custom entity because it represents a business relationship with state.

### Program

Could be a content type or custom entity depending on complexity.

Do not blindly implement every object as a custom entity.

Choose the simplest Drupal-native representation that satisfies:

* Relationships
* Permissions
* Views
* Workflows
* Extensibility

---

# 68. Avoid Overengineering

This project is an MVP.

Do not create abstractions merely because they might be useful someday.

Avoid:

```text
Generic Entity Framework
Generic Workflow Engine
Generic Analytics Platform
Generic Notification Framework
Generic API Gateway
```

unless an actual requirement justifies them.

Prefer simple Drupal-native implementations.

---

# 69. Suggested Development Order

Within each phase, follow this general order:

```text
1. Data model
2. Fields/relationships
3. Permissions
4. Views
5. Business logic
6. Forms/workflows
7. UI/theme
8. Tests
9. Documentation
```

This prevents UI work from hiding data-model problems.

---

# 70. Git / Commit Expectations

Keep commits logically grouped.

Examples:

```text
feat: add athlete and coach roles
feat: add challenge enrollment model
feat: add Squatober challenge
feat: add exercise and workout models
feat: add workout session tracking
feat: add athlete dashboard
feat: add check-ins
feat: add video submissions
feat: add coach review workflow
feat: add coaching relationships
```

Avoid one enormous commit containing the entire application.

---

# 71. Claude Deliverables

For each implementation phase, provide:

1. Files changed
2. Drupal configuration created/changed
3. Modules added
4. Database/entity changes
5. Permissions created/changed
6. Routes created
7. Views created
8. Environment variables required
9. Installation/update steps
10. Tests performed
11. Known limitations
12. Remaining work

Do not simply report:

```text
Implemented.
```

Give enough detail that the repository changes can be reviewed.

---

# 72. Claude Reporting Format

After completing each phase, provide a concise report using:

```text
## Implementation Summary

### Completed
- ...

### Files Changed
- ...

### Drupal Configuration
- ...

### Modules Added
- ...

### Permissions
- ...

### Routes / Views
- ...

### Environment Variables
- ...

### Tests
- ...

### Known Issues
- ...

### Next Recommended Step
- ...
```

---

# 73. Claude Instructions — First Action

Before modifying the repository, inspect it.

Specifically inspect:

```text
composer.json
composer.lock
compose.yaml
web/
drupal/
config/
modules/
themes/
.env*
README*
```

Use the actual repository structure rather than assuming these paths exist.

Determine:

* Drupal version
* PHP version
* Database
* Existing modules
* Existing custom code
* Existing configuration
* Existing theme
* Existing development workflow

Then compare the repository against this specification.

---

# 74. Claude Instructions — Do Not Assume

Do not assume:

* The repository is empty.
* The existing Docker configuration should be replaced.
* A module needs to be installed because it is listed here.
* Every entity needs custom PHP.
* Every page needs a custom controller.
* The Next.js site needs modification.
* The application needs a custom API.
* React is required for the authenticated interface.

Inspect first.

---

# 75. Claude Instructions — Drupal First

When a requirement can be solved cleanly with Drupal configuration, prefer configuration.

For example:

```text
Role
Field
Entity Reference
View
Permission
Media field
Basic form
```

should generally not become custom PHP unless there is a reason.

Custom code should primarily implement **SWC-specific business behavior**.

---

# 76. Claude Instructions — Data Integrity

Protect the distinction between:

```text
Prescription
```

and:

```text
Performance
```

Never modify a Workout merely because an Athlete performed something differently.

Likewise, do not turn derived Progress metrics into duplicated source-of-truth records without a specific reason.

---

# 77. Claude Instructions — Security

Pay particular attention to:

### Athlete data isolation

Athlete A must not be able to view Athlete B's private data.

### Coach access

Coach access should be scoped appropriately.

### Videos

Video submissions should use private/access-controlled storage.

### OAuth

Secrets must not enter Git.

### API

Do not accidentally expose private entities through JSON:API.

### Forms

Use Drupal's standard validation and CSRF protection.

---

# 78. Claude Instructions — Social Authentication

Social login must be treated as an identity layer.

Do not create:

```text
Google Athlete
Apple Athlete
Facebook Athlete
```

Instead create:

```text
One Drupal User
   |
   +-- Google identity
   +-- Apple identity
   +-- Facebook identity
```

Account linking should be designed carefully before implementation.

---

# 79. Claude Instructions — Squatober

Remember:

```text
Squatober
```

not:

```text
Squattober
```

SWC is participating in an existing Squatober community/event.

Do not implement language suggesting that SWC owns or created Squatober.

The Drupal data model should still be generic enough that Squatober is simply one Challenge.

---

# 80. Claude Instructions — Free Experience

Squatober registration and participation through SWC are free.

Do not add payment requirements to:

```text
Challenge Enrollment
```

The free experience is intentionally designed to generate coaching exposure and trust.

The business conversion occurs later through:

```text
Assessment
→ Coaching Relationship
→ Paid Program
```

---

# 81. Claude Instructions — Do Not Rebuild Next.js

The public Next.js website already exists.

Do not rebuild it.

Do not move authenticated Drupal functionality into Next.js simply because React is available.

The initial architecture intentionally uses:

```text
Next.js
=
Public marketing/sales

Drupal
=
Authenticated application/coaching backend
```

This is a deliberate decision.

---

# 82. Claude Instructions — Future React Integration

React/Next.js can be introduced later for specific areas where it materially improves the experience.

Examples:

* Highly interactive analytics
* Advanced workout logging
* Custom progress charts
* Mobile/PWA functionality
* Highly interactive public experiences

But do not make those requirements for the MVP.

---

# 83. Architectural North Star

The application should feel like this:

```text
                SQUAT WITH CONFIDENCE

                         |
                    FREE ENTRY
                         |
                    SQUATOBER
                         |
                      ATHLETE
                         |
                    ENGAGEMENT
                 /       |       \
            Workouts  Check-ins  Videos
                 \       |       /
                    COACHING
                    EXPOSURE
                         |
                    ASSESSMENT
                         |
                  COACHING RELATIONSHIP
                         |
                    PAID PROGRAM
```

The technology should make this journey simple.

---

# 84. Final Objective

The initial objective is **not** to build a massive fitness platform.

The objective is to build:

> **A clean, maintainable coaching application that makes Squatober genuinely useful to Athletes and naturally demonstrates the value of Squat With Confidence coaching.**

Build the simplest architecture that can accomplish that objective while leaving room for:

* Additional challenges
* Paid programs
* Multiple coaches
* Long-term coaching
* Mobile clients
* APIs
* CRM/email integrations
* Payments
* Advanced analytics

---

# 85. Final Instruction to Claude

**Inspect first. Architect second. Implement incrementally. Test continuously. Avoid unnecessary complexity.**

When making an implementation decision, favor:

```text
Simple
+
Drupal-native
+
Secure
+
Maintainable
+
Extensible
```

over:

```text
Custom
+
Complex
+
Prematurely optimized
```

The architecture described in this document is the current product direction. Preserve its core principles while adapting implementation details to the actual state of the repository.

```
```
