window.onscroll = () => {
  profile.classList.remove("active");
  navbar.classList.remove("active");
  searchForm.classList.remove("active");
};

document.querySelectorAll(".content-150").forEach((content) => {
  if (content.innerHTML.length > 150)
    content.innerHTML = content.innerHTML.slice(0, 150);
});
