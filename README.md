# 🎓 E-Learning System

A full-stack E-Learning platform that connects students and teachers.  
Teachers can create courses, upload educational content, and manage students, while students can browse, enroll in courses, and interact through blogs.

Built as a solo full-stack project using modern web technologies.

---

## ✨ Key Features

### 👤 Authentication & Roles
- User registration and login system
- Role-based system:
  - Student
  - Teacher
- Each role has different permissions and dashboards

---

### 👨‍🏫 Teacher Features
- Create and manage courses (only under admin-created categories)
- Upload course videos
- View enrolled students per course
- Create blogs/articles

---

### 🎓 Student Features
- Browse available courses
- Enroll in courses with one click (no payment required)
- Access enrolled course content
- Create and publish blogs

---

### 📚 Course System
- Organized by categories (managed by admin)
- Video-based learning structure
- Teacher-student relationship tracking

---

### 📝 Blog System
- Teachers can publish educational blogs
- Students can also create and share blogs after login
- Community-based learning content

---

## 🛠️ Tech Stack

### Frontend
- Vue.js
- SCSS (Sass)
- Component-based UI architecture

### Backend
- Laravel (REST API)
- Authentication & Role-based access control
- MVC architecture

### Database
- MySQL / SQLite (depending on setup)

---

## 🔐 System Roles

### 🧑‍🎓 Student
- View courses
- Enroll in courses
- Read/watch course content
- Create blogs

### 👨‍🏫 Teacher
- Create courses
- Upload videos
- Manage enrolled students
- Create blogs

### 🛡️ Admin
- Create and manage categories
- Control course structure

---

## ⚙️ Installation & Setup

### 1. Clone the repository
```bash id="x1a2b3"
git clone https://github.com/your-username/e-learning-system.git
cd e-learning-system
