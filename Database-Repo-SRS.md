## **ASOG TBI** 

**Template ng Dataset Repository** Palitan nyo nalang contents mwa 

Prepared by: **DOST-SEI PTP Scholar-Trainees** 

Organization: 

## **ASOG Technology Business Incubator (ASOG TBI)** 

Website: 

https://asogtbi.com 

Audit Date: 

## **June 17–19, 2026** 

https://chatgpt.com/share/6a4ca696-a594-83ec-9c92-77f33c11c296 = convo with gpt, feel free to modify the contents etc 

ASOG TBI Website Audit Report _June 2026_ 

## _Table of Contents_ 

_**Introduction.................................................................................................................................................3**_ Purpose.................................................................................................................................................. 3 Project Background................................................................................................................................ 3 Scope..................................................................................................................................................... 3 System Objectives................................................................................................................... 4 Intended Users........................................................................................................................ 4 Definitions................................................................................................................................ 5 _**Overall Description.....................................................................................................................................6**_ Product Perspective............................................................................................................................... 6 Prototype Basis...................................................................................................................................... 6 MVP Scope..............................................................................................................................7 Product Functions....................................................................................................................7 User Classes & Characteristics............................................................................................... 7 Operating Environment............................................................................................................8 Design & Implementation Constraints..................................................................................... 8 Assumptions & Dependencies.................................................................................................9 _**System Features & Functional Requirements......................................................................................... 9**_ MVP Functional Requirements................................................................................................9 Future Enhancement Requirements......................................................................................10 User Authentication & Account Management........................................................................10 Role-Based Access Control...................................................................................................10 Dataset Browsing...................................................................................................................11 Dataset Search...................................................................................................................... 11 Dataset Filtering.....................................................................................................................12 Dataset Detail Page...............................................................................................................12 Dataset Metadata Displayed..................................................................................................13 Dataset Upload & Submission...............................................................................................13 Dataset File Upload............................................................................................................... 14 Ethics & Privacy Review........................................................................................................ 14 Technical Review...................................................................................................................15 Dataset Approval & Publishing.............................................................................................. 15 Dataset Update......................................................................................................................16 Dataset Archive..................................................................................................................... 16 Dataset Archive..................................................................................................................... 16 Citation & BibTeX Generation................................................................................................17 Dataset Recommendation System........................................................................................ 17 Initial Recommendation Method...................................................................................... 18 Access Request for Restricted Datasets............................................................................... 18 Notifications........................................................................................................................... 19 Audit Logs & Monitoring.........................................................................................................19 

_DOST-SEI_ Page 1 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

Backup & Recovery............................................................................................................... 20 **External Interface Requirements..............................................................................................20** User Interface Requirements.................................................................................................20 Hardware Interface Requirements........................................................................................................21 Software Interface Requirements.......................................................................................... 21 Communication Interface Requirements............................................................................... 21 **Non-Functional Requirements................................................................................................. 22** Security Requirements.......................................................................................................... 22 Privacy Requirements............................................................................................................22 Performance Requirements...................................................................................................23 Reliability Requirements........................................................................................................23 Usability Requirements..........................................................................................................23 Maintainability Requirements.................................................................................................24 Scalability Requirements....................................................................................................... 24 **System Architecture..................................................................................................................24** Architecture Pattern...............................................................................................................24 Proposed CodeIgniter 4 Structure......................................................................................... 25 **Database Requirements............................................................................................................26** Proposed Database Tables.................................................................................................................. 26 Main Dataset Fields...............................................................................................................26 Dataset Submission Workflow............................................................................................... 27 Dataset Recommendation Workflow..................................................................................... 28 Dataset Archive Workflow......................................................................................................28 **Recommendation System Design............................................................................................28** Recommendation Inputs........................................................................................................28 Recommendation Output......................................................................................................................29 Initial Algorithm...................................................................................................................... 29 Future Recommendation Improvements............................................................................... 29 _**Data Privacy & Ethical Compliance.........................................................................................................30**_ Permitted Uses...................................................................................................................... 30 Prohibited Uses..................................................................................................................... 30 _**Acceptance Criteria & System Limitations.............................................................................................31**_ Acceptance Criteria............................................................................................................... 31 System Limitations.................................................................................................................31 _**Conclusion................................................................................................................................................ 32**_ 

_DOST-SEI_ Page 2 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## Introduction 

## **Purpose** 

This Software Requirements Specification defines the requirements for the development of the ASOG TBI Dataset Repository with Recommendation System. The system will be developed as a web-based institutional platform that allows authorized users to upload, manage, review, search, recommend, cite, download, update, and archive datasets. 

The system shall support the research, thesis, capstone, academic, analytics, artificial intelligence, and startup development needs of Camarines Sur Polytechnic Colleges and ASOG Technology Business Incubator. 

This SRS is intended to guide the system developers, project advisers, evaluators, repository administrators, ASOG TBI personnel, and other stakeholders involved in the implementation and evaluation of the proposed system 

## **Project Background** 

Datasets are important resources for research, innovation, technology development, artificial intelligence, machine learning, analytics, and computational modeling. However, many students, faculty researchers, and incubatees experience difficulty in finding accessible, reliable, and well-documented datasets. 

To address this need, the proposed system shall provide a centralized institutional dataset repository. The system will help store datasets generated from thesis, capstone projects, faculty research, AI and data analytics projects, and ASOG TBI-related initiatives. 

The project is based on an existing prototype documented in the system manual. The prototype already demonstrates core repository features such as dataset browsing, pagination, data type filtering, dataset detail pages, citation generation, dataset downloading, dataset uploading, updating, archiving, and similar dataset recommendations. The manual states that the prototype homepage displays available datasets with pagination and a data type filter option. It also shows that each dataset has a dedicated page containing metadata, citations, a download button, and recommendations for similar datasets. 

The final system shall be rebuilt from the ground up using CodeIgniter 4 PHP framework and MySQL as the backend database. 

## **Scope** 

The ASOG TBI Dataset Repository with Recommendation System shall be a web-based application that manages the complete dataset lifecycle, including: 

- Dataset submission 

- Metadata encoding 

- Dataset file upload 

- Ethics and privacy review 

- Technical review 

- Dataset approval 

- Dataset publishing 

- Dataset browsing 

   - Dataset recommendation 

   - Dataset citation 

   - Dataset download 

   - Dataset update 

   - Dataset archiving 

   - Access control 

   - Audit logging 

   - Backup and monitoring 

- Dataset search and filtering 

_DOST-SEI_ Page 3 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

The system shall improve the existing prototype by adding institutional-level features such as authentication, role-based access control, privacy validation, review workflow, approval tracking, administrative dashboards, audit logs, and compliance monitoring. 

## **System Objectives** 

The system aims to: 

1. Provide a centralized repository for institutional datasets. 

2. Support thesis, capstone, research, AI, analytics, and startup development. 

3. Make dataset discovery easier through search, filtering, and recommendations. 

4. Ensure dataset submissions are properly documented. 

5. Support ethical, secure, and responsible dataset sharing. 

6. Protect sensitive and confidential data through privacy review and access control. 

7. Promote dataset reuse, citation, transparency, and research reproducibility. 

8. Provide ASOG TBI and repository administrators with tools for monitoring and governance. 

## **Intended Users** 

|**User Type**|**Description**|
|---|---|
|**Student**|Submits or accesses datasets for thesis, capstone, and<br>academic projects|
|**Faculty Researcher**|Submits, reviews, or uses datasets for research|
|**Thesis/Capstone Adviser**|Guides students in preparing datasets and may validate<br>submissions|
|**Research Ethics Reviewer**|Reviews submitted datasets for ethics and privacy<br>compliance|
|**ASOG TBI Staff**|Oversees repository operations and dataset governance|
|**Repository Administrator**|Manages users, datasets, reviews, backups, logs, and<br>access control|
|**Incubatee/Startup User**|Uses datasets for prototyping, analytics, and model<br>development|
|**Authorized User**|Any approved user granted access to specific datasets|



_DOST-SEI_ Page 4 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Definitions** 

|**Term**|**Definition**|
|---|---|
|Dataset|A collection of data used for research, analytics, AI, training, testing, or<br>development|
|Metadata|Descriptive information about a dataset, such as title, description, source, category,<br>tags, and format|
|Repository|The centralized platform where datasets are stored and managed|
|Dataset Owner|The person or group who created, collected, or submitted the dataset|
|Contributor|A user who uploads or submits a dataset|
|Sensitive Data|Personal, confidential, or protected data that requires privacy safeguards|
|Anonymization|The process of removing personally identifiable information from a dataset|
|Review Workflow|The process of checking submitted datasets before approval|
|Ethics Review|Review process for privacy, consent, ethical clearance, and compliance|
|Technical Review|Review process for dataset quality, completeness, usability, and format|
|Recommendation System|A feature that suggests related datasets based on metadata similarity and user<br>activity|
|Archive|A function that hides a dataset from normal viewing without permanently deleting it|
|Citation|A formatted reference used to credit the dataset source or owner|
|BibTeX|A citation format commonly used in academic and research writing|
|Role-Based Access Control<br>(RBAC)|A permission system where access depends on the user’s assigned role|



_DOST-SEI_ Page 5 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## Overall Description 

## **Product Perspective** 

The system shall be developed as a new CodeIgniter 4 and MySQL-based web application. Although there is an existing prototype, the final system shall not simply modify the prototype. Instead, the prototype shall serve as the functional and visual reference for the new system. 

The previous prototype was implemented using Django, but the final implementation shall use: 

```
Backend Framework: CodeIgniter 4
Programming Language: PHP
Database: MySQL
Frontend: HTML, CSS, JavaScript, Bootstrap or Tailwind CSS
```

The final system shall preserve the prototype’s main behavior while adding the institutional policy requirements for dataset submission, review, access control, monitoring, and compliance. 

## **Prototype Basis** 

The prototype includes the following demonstrated features: 

|**Prototype Feature**|**Final System Requirement**|
|---|---|
|Homepage dataset list|A collection of data used for research, analytics, AI, training, testing, or<br>development|
|Pagination|Descriptive information about a dataset, such as title, description, source, category,<br>tags, and format|
|Search bar|The centralized platform where datasets are stored and managed|
|Data type filter|The person or group who created, collected, or submitted the dataset|
|Dataset detail page|A user who uploads or submits a dataset|
|Recommended datasets|Personal, confidential, or protected data that requires privacy safeguards|
|Citation popup|The process of removing personally identifiable information from a dataset|
|Download button|The process of checking submitted datasets before approval|
|Upload page|Review process for privacy, consent, ethical clearance, and compliance|
|Update feature|Review process for dataset quality, completeness, usability, and format|
|Archive feature|A feature that suggests related datasets based on metadata similarity and user<br>activity|



The prototype manual also shows that the citation feature includes “Copy Citation” and “Copy Bibtex,” while the download feature allows the main dataset files to be downloaded as a ZIP file. The upload feature redirects users to an upload page where metadata such as title and description are entered, and the dataset is uploaded as a compressed ZIP file. 

_DOST-SEI_ Page 6 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **MVP Scope** 

The Minimum Viable Product version of the ASOG TBI Dataset Repository with Recommendation System shall focus on the core dataset repository functions demonstrated in the prototype. The prototype already includes dataset browsing with pagination and data type filtering, dataset detail pages with metadata, citation, download, and similar dataset recommendations. 

For the MVP, the system shall include only the essential features needed to make the repository functional and testable. These include user login, dataset upload, dataset listing, search, filtering, dataset detail viewing, citation generation, dataset download, update, archive, admin approval, and basic content-based dataset recommendation. 

Advanced institutional features such as full ethics review workflow, multiple reviewer roles, access request management, annual compliance reporting, advanced audit logs, email notifications, and automated backup management shall be treated as future enhancements. 

## **Product Functions** 

The system shall provide the following major functions: 

1. User authentication 

2. Role-based dashboards 

3. Dataset browsing 

4. Dataset searching 

5. Dataset filtering 

6. Dataset detail viewing 

7. Dataset recommendation 

8. Dataset citation generation 

9. Dataset downloading 

10. Dataset upload and submission 

   12. Dataset update 

   13. Dataset archiving 

   14. Ethics and privacy review 

   15. Technical review 

   16. Dataset approval and publishing 

   17. Dataset access request 

   18. User and role management 

   19. Audit logs 

   20. Backup and recovery 

   21. Monitoring and compliance reporting 

11. Dataset metadata management 

## **User Classes & Characteristics** 

|**User Class**|**Skill Level**|**Main Activities**|
|---|---|---|
|Guest|Basic|View publicly available dataset listings and limited<br>metadata|
|Student|Basic - Intermediate|Upload, search, cite, request, and download<br>datasets|
|Faculty Researcher|Intermediate|Submit, review, search, and use datasets|
|Adviser|Intermediate|Validate or guide student dataset submissions|
|Ethics Reviewer|Intermediate|Review privacy, consent, and ethical compliance|
|Technical Reviewer|Intermediate - Advanced|Review dataset quality, format, completeness,<br>and usability|



_DOST-SEI_ Page 7 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

|ASOG TBI Staff|Intermediate|Manage dataset operations and institutional<br>workflow|
|---|---|---|
|Repository Administrator|Advanced|Manage users, datasets, roles, reviews, logs, and<br>system settings|



## **Operating Environment** 

|**Component**|**Requirement**|
|---|---|
|Platform|Web-based application|
|Backend Framework|CodeIgniter 4 (CI4)|
|Programming Language|PHP|
|Database|MySQL|
|Web Server|Apache/Nginx|
|Local Development Environment|XAMPP/Laragon/WAMP|
|Client Devices|Desktop, laptop, tablet or mobile browsers|
|Supported Browsers|Google Chrome, Microsoft Edge, Mozilla Firefox, Safari,<br>Opera/GX|
|File Storage|Protected server-side upload directory|
|Communication|HTTPS|
|Notification|Email or in-system notifications|
|Backup|Scheduled database and dataset file backup|



## **Design & Implementation Constraints** 

The system shall be developed under the following constraints: 

1. The system shall use CodeIgniter 4 as the main backend framework. 

2. The system shall use MySQL as the database backend. 

3. Dataset files shall be stored in a protected server-side directory. 

4. The database shall store dataset metadata and file references. 

5. The system shall follow the Model-View-Controller architecture. 

6. The system shall comply with institutional policies on data privacy, ethics, and dataset management. 

7. Sensitive datasets must not be published without proper review and approval. 

8. The system shall use role-based access control. 

9. The system shall log important user actions for accountability. 

10. Dataset upload shall support ZIP files as the main upload format. 

_DOST-SEI_ Page 8 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Assumptions & Dependencies** 

The system assumes that: 

1. ASOG TBI will provide the final dataset governance rules. 

2. Authorized reviewers will be assigned for ethics and technical review. 

3. Contributors will provide complete and accurate metadata. 

4. The institution will provide a hosting environment. 

5. Users will have access to a modern web browser. 

6. Dataset owners will comply with citation and intellectual property requirements. 

7. Administrators will regularly monitor the repository. 

8. Backup storage will be available. 

9. The final system will be deployed on an institutional server, VPS, shared hosting, or cloud server compatible with PHP and MySQL. 

## System Features & Functional Requirements 

## **MVP Functional Requirements** 

The priority requirements proposed for this project. 

|**ID**|**Requirement**|
|---|---|
|**MVP-FR-01**|The system shall allow users to log in using email and password.|
|**MVP-FR-02**|The system shall allow users to log out securely.|
|**MVP-FR-03**|The system shall support user registration or administrator-created accounts.|
|**MVP-FR-04**|The system shall allow password reset through email verification or administrator reset.|
|**MVP-FR-05**|The system shall store passwords using secure password hashing.|
|**MVP-FR-06**|The system shall prevent unauthorized access to protected pages.|
|**MVP-FR-07**|The system shall record login and logout activities in the audit log.|
|**MVP-FR-08**|The system shall allow administrators to activate or deactivate user accounts.|
|**MVP-FR-09**|The system shall allow users to download approved datasets.|
|**MVP-FR-10**|The system shall generate dataset citations and BibTeX.|
|**MVP-FR-11**|The system shall recommend similar datasets based on metadata.|
|**MVP-FR-12**|The system shall allow authorized users to update and archive datasets.|



_DOST-SEI_ Page 9 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Future Enhancement Requirements** 

Specifications required to meet ongoing standards. 

|**ID**|**Requirement**|
|---|---|
|**FE-FR-01**|The system may support a full ethics and privacy review workflow.|
|**FE-FR-02**|The system may support multiple reviewer roles.|
|**FE-FR-03**|The system may support restricted dataset access requests.|
|**FE-FR-04**|The system may support email notifications.|
|**FE-FR-05**|The system may support automated backup and recovery management.|
|**FE-FR-06**|The system may support advanced audit and compliance reports.|
|**FE-FR-07**|The system may support advanced AI-based recommendation methods.|



## **User Authentication & Account Management** 

The system shall allow users to securely access the platform using account credentials. 

|**ID**|**Requirement**|
|---|---|
|**FR-001**|The system shall allow users to log in using email and password.|
|**FR-002**|The system shall allow users to log out securely.|
|**FR-003**|The system shall support user registration or administrator-created accounts.|
|**FR-004**|The system shall allow password reset through email verification or administrator reset.|
|**FR-005**|The system shall store passwords using secure password hashing.|
|**FR-006**|The system shall prevent unauthorized access to protected pages.|
|**FR-007**|The system shall record login and logout activities in the audit log.|
|**FR-008**|The system shall allow administrators to activate or deactivate user accounts.|



## **Role-Based Access Control** 

The system shall restrict user actions based on assigned roles. 

|**ID**|**Requirement**|
|---|---|
|**FR-009**|The system shall assign one or more roles to each user.|



_DOST-SEI_ Page 10 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

|**FR-010**|The system shall restrict administrative functions to repository administrators.|
|---|---|
|**FR-011**|The system shall restrict review functions to assigned reviewers.|
|**FR-012**|The system shall restrict dataset update and archive functions to authorized users.|
|**FR-013**|The system shall restrict downloads of protected datasets to approved users.|
|**FR-014**|The system shall show different dashboard options depending on user role.|
|**FR-015**|The system shall allow administrators to modify user roles.|



## **Dataset Browsing** 

The system shall provide a homepage or repository catalog where users can browse available datasets. 

|**ID**|**Requirement**|
|---|---|
|**FR-016**|The system shall assign one or more roles to each user.|
|**FR-017**|The system shall restrict administrative functions to repository administrators.|
|**FR-018**|The system shall restrict review functions to assigned reviewers.|
|**FR-019**|The system shall restrict dataset update and archive functions to authorized users.|
|**FR-020**|The system shall restrict downloads of protected datasets to approved users.|
|**FR-021**|The system shall show different dashboard options depending on user role.|



## **Dataset Search** 

The system shall allow users to search for datasets using keywords. 

|**ID**|**Requirement**|
|---|---|
|**FR-022**|The system shall provide a search bar for dataset searching.|
|**FR-023**|The system shall allow users to search by dataset title.|
|**FR-024**|The system shall allow users to search by description.|
|**FR-025**|The system shall allow users to search by tags or keywords.|
|**FR-026**|The system shall allow users to search by category.|
|**FR-027**|The system shall return matching datasets based on the search query.|
|**FR-028**|The system shall display a message when no matching datasets are found.|



_DOST-SEI_ Page 11 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Dataset Filtering** 

The system shall allow users to filter datasets by data type and other metadata. 

|**ID**|**Requirement**|
|---|---|
|**FR-029**|The system shall allow filtering by data type.|
|**FR-030**|The system shall support data type filters such as Text, Image, Audio, Video, and Tabular.|
|**FR-031**|The system shall allow filtering by file format.|
|**FR-032**|The system shall allow filtering by category.|
|**FR-033**|The system shall allow filtering by date uploaded.|
|**FR-034**|The system shall return matching datasets based on the search query.|
|**FR-035**|The system shall display only datasets that match the selected filter.|



The prototype already demonstrates data type filtering, where selecting “Text” shows only datasets with the Text data type. 

## **Dataset Detail Page** 

The system shall provide a dedicated detail page for each dataset. 

|**ID**|**Requirement**|
|---|---|
|**FR-036**|The system shall allow users to click a dataset from the listing.|
|**FR-037**|The system shall redirect users to a dedicated dataset detail page.|
|**FR-038**|The system shall display complete dataset metadata.|
|**FR-039**|The system shall display research information related to the dataset.|
|**FR-040**|The system shall display source and reference information.|
|**FR-041**|The system shall display the date uploaded.|
|**FR-042**|The system shall display dataset access status.|
|**FR-043**|The system shall display recommended datasets related to the selected dataset.|
|**FR-044**|The system shall provide buttons for citation, download, update, and archive depending on user<br>role.|



_DOST-SEI_ Page 12 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Dataset Metadata Displayed** 

The dataset detail page shall display: 

- Dataset title 

- Data type 

- File format 

- Description 

- Category 

- Tags or keywords 

- Source 

- Reference link 

- Form 

- Date uploaded 

- Research title 

- Project head 

- Members 

- Contributor 

- Access type 

- Version number 

## **Dataset Upload & Submission** 

The system shall allow authorized users to upload datasets through a guided submission form. 

|**ID**|**Requirement**|
|---|---|
|**FR-045**|The system shall provide an upload dataset page.|
|**FR-046**|The system shall require users to enter the dataset title.|
|**FR-047**|The system shall require users to enter the dataset description.|
|**FR-048**|The system shall require users to enter tags or keywords.|
|**FR-049**|The system shall require users to enter a category.|
|**FR-050**|The system shall require users to select data type.|
|**FR-051**|The system shall require users to select file format.|
|**FR-052**|The system shall require users to enter a research title.|
|**FR-053**|The system shall require users to enter project head or adviser.|
|**FR-054**|The system shall allow users to enter research members.|
|**FR-055**|The system shall require users to select source type.|
|**FR-056**|The system shall allow users to provide a source link or reference.|
|**FR-057**|The system shall require users to upload the dataset file in ZIP format.|
|**FR-058**|The system shall validate required fields before submission.|
|**FR-059**|The system shall save submitted datasets with a “Pending Review” status.|



_DOST-SEI_ Page 13 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

**FR-060** The system shall notify the contributor after successful submission. 

## **Dataset File Upload** 

The system shall handle dataset file uploads securely. 

|**ID**|**Requirement**|
|---|---|
|**FR-061**|The system shall accept ZIP files for dataset upload.|
|**FR-062**|The system shall validate file type before accepting upload.|
|**FR-063**|The system shall reject unsupported file types.|
|**FR-064**|The system shall store uploaded files in a protected server directory.|
|**FR-065**|The system shall generate a unique filename for each uploaded file.|
|**FR-066**|The system shall store file path, file size, file type, and upload date in the database.|
|**FR-067**|The system shall prevent direct public access to uploaded files.|
|**FR-068**|The system shall allow only authorized users to download files.|



## **Ethics & Privacy Review** 

The system shall support review of datasets for privacy, ethical, and legal compliance. 

|**ID**|**Requirement**|
|---|---|
|**FR-069**|The system shall route submitted datasets to an ethics or privacy reviewer.|
|**FR-070**|The system shall allow reviewers to view submitted metadata and files.|
|**FR-071**|The system shall allow reviewers to approve a dataset.|
|**FR-072**|The system shall allow reviewers to reject a dataset.|
|**FR-073**|The system shall allow reviewers to request revision.|
|**FR-074**|The system shall allow reviewers to add comments.|
|**FR-075**|The system shall require confirmation that sensitive personal data has been anonymized.|
|**FR-076**|The system shall prevent datasets from proceeding if ethics review is not approved.|
|**FR-077**|The system shall record review decisions in the audit log.|
|**FR-078**|The system shall notify contributors of review results.|



_DOST-SEI_ Page 14 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Technical Review** 

The system shall support technical validation of dataset quality and completeness. 

|**ID**|**Requirement**|
|---|---|
|**FR-079**|The system shall route privacy-approved datasets to technical review.|
|**FR-080**|The system shall allow technical reviewers to inspect dataset metadata.|
|**FR-081**|The system shall allow technical reviewers to verify the uploaded ZIP file.|
|**FR-082**|The system shall allow technical reviewers to check file readability.|
|**FR-083**|The system shall allow technical reviewers to check completeness of documentation.|
|**FR-084**|The system shall allow technical reviewers to approve the dataset.|
|**FR-085**|The system shall allow technical reviewers to reject the dataset.|
|**FR-086**|The system shall allow technical reviewers to request revision.|
|**FR-087**|The system shall notify contributors of technical review results.|
|**FR-088**|The system shall prevent publishing of technically rejected datasets.|



## **Dataset Approval & Publishing** 

The system shall publish datasets only after required review and approval. 

|**ID**|**Requirement**|
|---|---|
|**FR-089**|The system shall allow administrators to publish approved datasets.|
|**FR-090**|The system shall mark published datasets as “Approved” or “Published.”|
|**FR-091**|The system shall make published datasets visible in the repository catalog.|
|**FR-092**|The system shall prevent pending datasets from appearing in public listings.|
|**FR-093**|The system shall prevent rejected datasets from being downloaded by users.|
|**FR-094**|The system shall allow administrators to set the dataset access type.|
|**FR-095**|The system shall support public, institutional-only, restricted, and private access types.|



_DOST-SEI_ Page 15 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Dataset Update** 

The system shall allow authorized users to update dataset information. 

|**ID**|**Requirement**|
|---|---|
|**FR-096**|The system shall provide an update button for authorized users.|
|**FR-097**|The update page shall be pre-filled with existing dataset information.|
|**FR-098**|The system shall allow authorized users to edit dataset metadata.|
|**FR-099**|The system shall allow authorized users to upload a new dataset file version.|
|**FR-100**|The system shall require re-review if major dataset changes are made.|
|**FR-101**|The system shall record update history.|
|**FR-102**|The system shall notify administrators when a dataset is updated.|



## **Dataset Archive** 

The system shall allow authorized users to archive datasets without permanently deleting them. 

|**ID**|**Requirement**|
|---|---|
|**FR-103**|The system shall provide an archive button for authorized users.|
|**FR-104**|The system shall hide archived datasets from normal browsing.|
|**FR-105**|The system shall retain archived dataset files and metadata.|
|**FR-106**|The system shall allow administrators to view archived datasets.|
|**FR-107**|The system shall allow administrators to restore archived datasets.|
|**FR-108**|The system shall record archive and restore actions in the audit log.|



The prototype manual states that the archive button hides a dataset from view without permanently deleting its content. 

## **Dataset Archive** 

The system shall allow authorized users to archive datasets without permanently deleting them. 

|**ID**|**Requirement**|
|---|---|
|**FR-109**|The system shall provide a download button on the dataset detail page.|
|**FR-110**|The system shall allow users to download dataset files in ZIP format.|



_DOST-SEI_ Page 16 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

|**FR-111**|The system shall require users to agree to usage conditions before downloading restricted<br>datasets.|
|---|---|
|**FR-112**|The system shall prevent unauthorized downloads.|
|**FR-113**|The system shall record each download in the download log.|
|**FR-114**|The system shall display file size before downloading.|
|**FR-115**|The system shall allow administrators to view download statistics.|



## **Citation & BibTeX Generation** 

The system shall allow users to generate citations for datasets. 

|**ID**|**Requirement**|
|---|---|
|**FR-116**|The system shall provide a citation button on the dataset detail page.|
|**FR-117**|The system shall display a citation popup.|
|**FR-118**|The system shall generate a plain-text citation.|
|**FR-119**|The system shall generate a BibTeX citation.|
|**FR-120**|The system shall allow users to copy citation text.|
|**FR-121**|The system shall allow users to copy BibTeX text.|
|**FR-122**|The system shall include dataset title, owner, year, and repository name in citation output.|



## **Dataset Recommendation System** 

The system shall recommend similar or relevant datasets to users. 

|**ID**|**Requirement**|
|---|---|
|**FR-123**|The system shall display recommended datasets on the dataset detail page.|
|**FR-124**|The system shall recommend datasets based on metadata similarity.|
|**FR-125**|The system shall compare datasets using title, description, category, tags, keywords, data type,<br>and file format.|
|**FR-126**|The system shall allow users to click recommended datasets.|
|**FR-127**|The system shall redirect users to the detail page of a recommended dataset.|
|**FR-128**|The system shall not recommend archived datasets.|



_DOST-SEI_ Page 17 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

|**FR-129**|The system shall not recommend datasets the user is not authorized to view.|
|---|---|
|**FR-130**|The system shall display a fixed number of recommended datasets, such as five related<br>datasets.|



## **Initial Recommendation Method** 

The system shall initially use a content-based recommendation approach. 

Recommended datasets shall be determined through metadata similarity using weighted factors: 

|**Similarity Factors**|**Suggested Weight**|
|---|---|
|**Category match**|30%|
|**Tag or keyword match**|30%|
|**Data type match**|15%|
|**File format match**|10%|
|**Description similarity**|15%|



## **Access Request for Restricted Datasets** 

The system shall allow users to request access to restricted datasets. 

|**ID**|**Requirement**|
|---|---|
|**FR-131**|The system shall display an access request button for restricted datasets.|
|**FR-132**|The system shall require users to state the purpose of access.|
|**FR-133**|The system shall submit the access request to the dataset owner, ASOG TBI staff, or<br>administrator.|
|**FR-134**|The system shall allow authorized approvers to approve or reject access requests.|
|**FR-135**|The system shall notify users whether their restricted dataset access request is approved or<br>rejected.|
|**FR-136**|The system shall record access request history.|
|**FR-137**|The system shall allow approved users to download the restricted dataset.|



_DOST-SEI_ Page 18 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Notifications** 

The system shall notify users of important repository actions. 

|**ID**|**Requirement**|
|---|---|
|**FR-138**|The system shall notify users after successful dataset submission.|
|**FR-139**|The system shall notify reviewers of pending review tasks.|
|**FR-140**|The system shall notify contributors of approval, rejection, or revision requests.|
|**FR-141**|The system shall support in-system notifications for important user actions and system updates.|
|**FR-142**|The system shall notify administrators of important system activities.|
|**FR-143**|The system shall support in-system notifications.|
|**FR-144**|The system may support email notifications.|



## **Audit Logs & Monitoring** 

The system shall record important user and system activities for monitoring and compliance. 

|**ID**|**Requirement**|
|---|---|
|**FR-145**|The system shall log user login and logout.|
|**FR-146**|The system shall log dataset uploads.|
|**FR-147**|The system shall log dataset updates.|
|**FR-148**|The system shall log dataset archives and restore actions.|
|**FR-149**|The system shall log review decisions.|
|**FR-150**|The system shall log dataset downloads.|
|**FR-151**|The system shall log access request decisions.|
|**FR-152**|The system shall allow administrators to view audit logs.|
|**FR-153**|The system shall allow administrators to generate usage reports.|
|**FR-154**|The system shall support annual repository usage review.|



_DOST-SEI_ Page 19 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Backup & Recovery** 

The system shall support backup and recovery of database records and dataset files. 

|**ID**|**Requirement**|
|---|---|
|**FR-155**|The system shall allow administrators to back up the MySQL database.|
|**FR-156**|The system shall support backup of uploaded dataset files.|
|**FR-157**|The system shall record backup date and backup status.|
|**FR-158**|The system shall allow restoration from available backups.|
|**FR-159**|The system shall prevent unauthorized users from performing backup and restore actions.|
|**FR-160**|The system shall retain dataset records based on institutional retention policies.|



## External Interface Requirements 

## **User Interface Requirements** 

The system shall provide a clean, responsive, and user-friendly interface. 

|**Interface**|**Description**|
|---|---|
|**Login Page**|Allows users to log in|
|**Registration Page**|Allows users to create an account, if enabled|
|**Dashboard**|Displays user-specific actions and notifications|
|**Dataset Repository Homepage**|Displays approved datasets with search, filter, and<br>pagination|
|**Dataset Detail Page**|Displays complete metadata, download, citation, and<br>recommendations|
|**Upload Dataset Page**|Allows contributors to submit dataset metadata and ZIP file|
|**Update Dataset Page**|Allows authorized users to modify dataset information|
|**Review Dashboard**|Allows reviewers to approve, reject, or request revision|
|**Admin Dashboard**|Allows administrators to manage users, roles, datasets,<br>logs, and backups|
|**Access Request Page**|Allows users to request access to restricted datasets|
|**Reports Page**|Displays downloads, views, submissions, and audit logs|



_DOST-SEI_ Page 20 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Hardware Interface Requirements** 

The system shall not require specialized client hardware. 

Minimum client requirements: 

Server requirements: 

- Computer, laptop, tablet, or smartphone 

- Internet connection 

- Modern web browsers 

- PHP-compatible server 

- MySQL database server 

- Sufficient storage for uploaded datasets 

- Backup storage 

## **Software Interface Requirements** 

|**Software Component**|**Purpose**|
|---|---|
|**CodeIgniter 4**|Main PHP backend framework|
|**MySQL**|Primary database backend|
|**PHP**|Server-side programming language|
|**Apache/Nginx**|Web server|
|**HTML/CSS/JavaScript**|Frontend interface|
|**Bootstrap or Tailwind CSS**|UI styling|
|**SMTP/Email Server**|Email notifications|
|**File Storage Directory**|Dataset file storage|
|**Browser**|Client-side access|



## **Communication Interface Requirements** 

|**Software Component**|**Description**|
|---|---|
|**HTTPS**|The system shall use HTTPS during deployment|
|**HTTP Localhost**|Development may run locally using Apache through XAMPP or<br>Laragon|
|**Email Protocol**|The system may use SMTP for notifications|
|**File Transfer**|Dataset files shall be uploaded through secure web forms|



_DOST-SEI_ Page 21 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## Non-Functional Requirements 

## **Security Requirements** 

|**ID**|**Requirement**|
|---|---|
|**NFR-001**|The system shall use secure user authentication.|
|**NFR-002**|The system shall hash user passwords.|
|**NFR-003**|The system shall implement role-based access control.|
|**NFR-004**|The system shall prevent unauthorized access to restricted pages.|
|**NFR-005**|The system shall prevent direct access to protected uploaded files.|
|**NFR-006**|The system shall validate uploaded files.|
|**NFR-007**|The system shall protect against common web vulnerabilities such as SQL injection and<br>cross-site scripting.|
|**NFR-008**|The system shall use CodeIgniter 4 validation and security features.|
|**NFR-009**|The system shall log sensitive actions.|
|**NFR-010**|The system shall support HTTPS during deployment.|



## **Privacy Requirements** 

|**ID**|**Requirement**|
|---|---|
|**NFR-011**|The system shall support compliance with the Data Privacy Act of 2012.|
|**NFR-012**|The system shall require anonymization of datasets containing sensitive personal information.|
|**NFR-013**|The system shall restrict access to sensitive datasets.|
|**NFR-014**|The system shall store consent and clearance documents securely, if applicable.|
|**NFR-015**|The system shall allow reviewers to reject datasets with privacy issues.|
|**NFR-016**|The system shall prevent public exposure of private or restricted datasets.|



_DOST-SEI_ Page 22 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Performance Requirements** 

|**ID**|**Requirement**|
|---|---|
|**NFR-017**|The system shall load common pages within 3 seconds under normal conditions.|
|**NFR-018**|The system shall return search results within a reasonable response time.|
|**NFR-019**|The system shall display recommended datasets within a reasonable response time.|
|**NFR-020**|The system shall support multiple concurrent institutional users.|
|**NFR-021**|The system shall support pagination to reduce page loading time.|



## **Reliability Requirements** 

|**ID**|**Requirement**|
|---|---|
|**NFR-022**|The system shall remain available during institutional operating hours.|
|**NFR-023**|The system shall preserve uploaded dataset records even if a dataset is archived.|
|**NFR-024**|The system shall prevent accidental permanent deletion of datasets.|
|**NFR-025**|The system shall provide clear error messages during failed upload or validation.|
|**NFR-026**|The system shall support backup and recovery procedures.|



## **Usability Requirements** 

|**ID**|**Requirement**|
|---|---|
|**NFR-027**|The system shall provide a simple and understandable interface.|
|**NFR-028**|The system shall use clear labels for forms and buttons.|
|**NFR-029**|The system shall provide search and filter options on the repository page.|
|**NFR-030**|The system shall allow users to easily copy citations.|
|**NFR-031**|The system shall clearly show dataset status.|
|**NFR-032**|The system shall be usable on desktop and mobile browsers.|



_DOST-SEI_ Page 23 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Maintainability Requirements** 

|**ID**|**Requirement**|
|---|---|
|**NFR-033**|The system shall follow CodeIgniter 4 MVC structure.|
|**NFR-034**|The system shall organize logic into controllers, models, views, filters, and helpers.|
|**NFR-035**|The system shall use reusable components where applicable.|
|**NFR-036**|The system shall include comments for important functions.|
|**NFR-037**|The system shall allow future expansion of features.|



## **Scalability Requirements** 

|**ID**|**Requirement**|
|---|---|
|**NFR-038**|The system shall support growth in the number of users.|
|**NFR-039**|The system shall support growth in the number of datasets.|
|**NFR-040**|The system shall allow additional dataset types in the future.|
|**NFR-041**|The system shall allow improvement of the recommendation algorithm in future versions.|
|**NFR-042**|The system shall allow migration to larger storage if needed.|



## System Architecture 

## **Architecture Pattern** 

The system shall use the Model-View-Controller architecture provided by CodeIgniter 4. 

|**Component**|**Responsibility**|
|---|---|
|**Model**|Handles database operations and data validation|
|**View**|Displays user interfaces|
|**Controller**|Processes user requests and system logic|
|**Filter**|Handles authentication and role checking|
|**Helper**|Provides reusable utility functions|
|**Database**|Stores structured system data|
|**File Storage**|Stores uploaded dataset files|



_DOST-SEI_ Page 24 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Proposed** _**CodeIgniter 4**_ **Structure** 

`app/` ├── `Controllers/` │ ├── `Auth.php` │ ├── `Dashboard.php` │ ├── `Datasets.php` │ ├── `DatasetUpload.php` │ ├── `Reviews.php` │ ├── `Recommendations.php` │ ├── `AccessRequests.php` │ ├── `Admin.php` │ ├── `Reports.php` │ └── `Backups.php` │ ├── `Models/` │ ├── `UserModel.php` │ ├── `RoleModel.php` │ ├── `DatasetModel.php` │ ├── `DatasetFileModel.php` │ ├── `DatasetMetadataModel.php` │ ├── `ReviewModel.php` │ ├── `AccessRequestModel.php` │ ├── `RecommendationModel.php` │ ├── `DownloadLogModel.php` │ ├── `AuditLogModel.php` │ └── `BackupModel.php` │ ├── `Views/` │ ├── `auth/` │ ├── `dashboard/` │ ├── `datasets/` │ ├── `upload/` │ ├── `reviews/` │ ├── `admin/` │ ├── `reports/` │ └── `layouts/` │ ├── `Filters/` │ ├── `AuthFilter.php` │ └── `RoleFilter.php` │ └── `Helpers/` ├── `citation_helper.php` ├── `recommendation_helper.php` ├── `upload_helper.php` └── `audit_helper.php` 

_DOST-SEI_ Page 25 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## Database Requirements 

## **Proposed Database Tables** 

|**Table**|**Purpose**|
|---|---|
|**users**|Stores user account information|
|**roles**|Stores system roles|
|**user_roles**|Links users to roles|
|**datasets**|Stores main dataset records|
|**datasets_metadata**|Stores detailed dataset metadata|
|**dataset_files**|Stores uploaded file information|
|**dataset_versions**|Stores version history|
|**reviews**|Stores ethics and technical review records|
|**access_requests**|Stores restricted dataset access requests|
|**dataset_downloads**|Stores download records|
|**dataset_views**|Stores dataset view records|
|**citations**|Stores generated citation information|
|**recommendations**|Stores cached recommendation results, if needed|
|**notifications**|Stores user notifications|
|**audit_logs**|Stores user and system activity logs|
|**backups**|Stores backup records|



## **Main Dataset Fields** 

The _datasets_ table may include: 

|**Field**|**Description**|
|---|---|
|**dataset_id**|Unique dataset ID|
|**title**|Dataset title|
|**description**|Dataset description|
|**data_type**|Text, Image, Audio, Video, Tabular, etc.|



_DOST-SEI_ Page 26 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

|**file_format**|CSV, TXT, DOCX, ZIP, JPG, PNG, etc.|
|---|---|
|**category**|Dataset category|
|**tags**|Dataset tags or keywords|
|**source_type**|Primary or secondary|
|**source_link**|Source reference or URL|
|**form**|Raw, processed, cleaned, etc.|
|**research_title**|Related research title|
|**project_head**|Project head or adviser|
|**members**|Research members|
|**contributor_id**|User who submitted the dataset|
|**status**|Pending, approved, rejected, revision, archived|
|**access_type**|Public, institutional, restricted, private|
|**version**|Dataset version|
|**date_uploaded**|Upload date|
|**date_updated**|Last update date|



## System Workflow 

## **Dataset Submission Workflow** 

|1|User logs in.|
|---|---|
|2|User opens the upload dataset page.|
|3|User enters dataset metadata.|
|4|User enters research information.|
|5|User enters source and reference information.|
|6|User uploads the dataset ZIP file.|
|7|System validates the input.|
|8|System saves the dataset as “Pending Review.”|
|9|Reviewer checks ethics and privacy compliance.|
|10|If rejected, the dataset is returned for revision.|
|11|If approved, the dataset proceeds to technical review|



_DOST-SEI_ Page 27 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

|12|Technical reviewer checks quality and completeness.|
|---|---|
|13|If approved, administrator publishes the dataset.|
|14|Dataset appears in the repository catalog.|
|15|Users may search, filter, view, cite, request, or download the dataset.|



## **Dataset Recommendation Workflow** 

|1|User opens a dataset detail page.|
|---|---|
|2|System reads the dataset’s metadata.|
|3|System compares the dataset with other approved datasets.|
|4|System calculates similarity scores.|
|5|System excludes archived or unauthorized datasets.|
|6|System displays the most relevant datasets.|
|7|User clicks a recommended dataset.|
|8|System redirects the user to the selected dataset detail page.|



## **Dataset Archive Workflow** 

|1|Authorized user clicks the archive button.|
|---|---|
|2|System asks for confirmation.|
|3|System changes dataset status to “Archived.”|
|4|Dataset is hidden from normal browsing.|
|5|System keeps dataset files and metadata.|
|6|System records the action in the audit log.|



## Recommendation System Design 

## **Recommendation Inputs** 

The recommendation system shall use: 

- Dataset title 

- Dataset description 

- Category 

- Tags 

- Keywords 

- Data type 

- File format 

- Source type 

- User views 

- User downloads 

- User searches, if available 

_DOST-SEI_ Page 28 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## **Recommendation Output** 

The system shall display: 

- Recommended dataset title 

- Data type 

- Short description or category 

- Clickable link to dataset detail page 

## **Initial Algorithm** 

The first version shall use a metadata-based content recommendation method. 

Example scoring: 

```
Recommendation Score =
Category Match +
Tag Similarity +
Data Type Match +
File Format Match +
Description Keyword Similarity
```

If the current dataset is: 

```
Title: Twitter Sentiment Analysis
Data Type: Text
Category: Social Media
Tags: Twitter, sentiment, analysis, text
```

The system may recommend: 

```
Social Media Trends 2023
Social Media User Behavior
Celebrity Social Media Posts
Social Media Ad Spending
Instagram Influencer Metrics
```

This approach is realistic for a CodeIgniter 4 and MySQL implementation because it can be done using PHP logic and database queries. 

## **Future Recommendation Improvements** 

Future versions may include: 

- TF-IDF similarity 

- Cosine similarity 

- Collaborative filtering 

   - AI-powered semantic search 

   - • Research interest profiling 

   - Dataset quality scoring 

- User personalization 

_DOST-SEI_ Page 29 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## Data Privacy & Ethical Compliance 

The system shall support responsible dataset handling by requiring: 

- Dataset anonymization when personal 

   - data is involved. 

- Consent documentation when applicable. 

- Ethics review before publication. 

- Restricted access for sensitive datasets. 

      - Secure storage of uploaded files. 

      - Administrative monitoring. 

      - Compliance with institutional research policies. 

      - Compliance with the Data Privacy Act of 2012. 

- Audit logging of downloads and access 

   - requests. 

Datasets containing personal, confidential, or sensitive information shall not be publicly available unless properly anonymized and approved. 

## Dataset Access & Use Policy Support 

## **Permitted Uses** 

The system shall support dataset use for: 

- Academic activities 

   - Research and analytics 

- Thesis and capstone development 

   - Model or product prototyping 

- AI training and testing 

- Institutional innovation activities 

## **Prohibited Uses** 

The system shall prohibit: 

- Unauthorized commercial use 

   - Misrepresenting dataset sources 

- Sharing outside approved conditions 

- Attempting to re-identify anonymized subjects 

   - Downloading restricted datasets without approval 

   - Publishing unreviewed datasets 

- Uploading malicious files 

- Deleting datasets without authorization 

_DOST-SEI_ Page 30 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## Acceptance Criteria & System Limitations 

## **Acceptance Criteria** 

The system shall be considered acceptable when: 

- Users can log in and access role-based dashboards. 

- Users can browse approved datasets. 

- Dataset listings support pagination. 

- Users can search datasets. 

- Users can filter datasets by data type. 

- Users can open a dataset detail page. 

- Dataset detail pages display complete metadata and research information. 

- Users can view recommended datasets. 

- Recommended datasets are clickable. 

- Users can generate citation and BibTeX references. 

- Authorized users can download dataset ZIP files. 

- Contributors can upload datasets with metadata and files. 

- Submitted datasets undergo review before publishing. 

- Reviewers can approve, reject, or request revision. 

- Administrators can publish approved datasets. 

- Authorized users can update dataset information. 

- Authorized users can archive datasets. 

- Archived datasets are hidden from normal browsing. 

- Restricted datasets require access approval. 

- The system records important actions in audit logs. 

- Administrators can manage users, roles, datasets, reviews, and backups. 

- The system runs using CodeIgniter 4 and MySQL. 

## **System Limitations** 

The initial version of the system may have the following limitations: 

- Recommendation may be based only on metadata similarity. 

- The system may not initially use machine learning. 

- Dataset previews may not be supported for all file types. 

- Large dataset uploads may depend on server upload limits. 

- Email notifications may depend on SMTP configuration. 

- External institutional login or single sign-on may be added in future versions. 

- Advanced analytics dashboards may be implemented in later releases. 

_DOST-SEI_ Page 31 

_PTP_ 

ASOG TBI Website Audit Report _June 2026_ 

## Conclusion 

The ASOG TBI Dataset Repository with Recommendation System is proposed as a centralized, web-based platform for storing, managing, discovering, citing, downloading, and recommending institutional datasets. The system is intended to support students, faculty researchers, thesis and capstone groups, ASOG TBI incubatees, and other authorized users who need reliable and well-documented datasets for academic research, software development, artificial intelligence, analytics, and innovation-related projects. 

The project is grounded on an existing prototype that already demonstrates the core concept of the system, including dataset browsing, pagination, filtering by data type, dataset detail viewing, citation generation, dataset downloading, uploading, updating, archiving, and similar dataset recommendations. These prototype features serve as the main functional basis of the proposed system. However, the final implementation shall be rebuilt from the ground up using CodeIgniter 4 PHP framework and MySQL as the database backend to better align with the preferred development stack and deployment environment. 

In regard to development feasibility, the system shall be approached through a Minimum Viable Product strategy. The MVP shall focus only on the most essential and testable features needed to make the repository functional. These include user authentication, basic role management, dataset upload, metadata entry, dataset listing, search, data type filtering, pagination, dataset detail pages, citation and BibTeX generation, dataset downloading, update, archive, admin approval, and metadata-based dataset recommendation. This MVP scope ensures that the project remains realistic, manageable, and achievable within the available development time while still delivering the main value of the system. 

Advanced institutional features such as full ethics review workflow, multiple reviewer roles, restricted dataset access requests, advanced audit reports, automated backup management, email notifications, and AI-based recommendation methods shall be considered as future enhancements. These features remain important for the long-term vision of the system, but they are not required for the first working version. By separating the MVP features from future enhancements, the project avoids becoming too broad while still maintaining a clear path for expansion. 

The initial recommendation feature shall use a practical content-based approach by comparing dataset metadata such as title, description, category, tags, data type, and file format. This allows the system to provide useful dataset suggestions without requiring complex machine learning implementation during the MVP phase. As more datasets and user activity are collected, the recommendation system may later be improved through more advanced methods. 

Overall, the proposed system is viable as an MVP because its core functions are clearly defined, technically achievable, and already supported by the existing prototype concept. The project balances practicality and institutional relevance by first delivering a working dataset repository with recommendation features, then allowing future development to expand the system into a more complete research data management platform. Through this phased approach, the ASOG TBI Dataset Repository with Recommendation System can contribute to better dataset accessibility, research productivity, data reuse, proper citation, and innovation support within the institution. 

_DOST-SEI_ Page 32 

_PTP_ 

