import './bootstrap';
import { Notyf } from 'notyf';
import "@fortawesome/fontawesome-free/css/all.min.css";
import 'notyf/notyf.min.css'; // for React,

const notyf = new Notyf();

document.addEventListener('DOMContentLoaded', () => {
  loadPrefecture();
  loadYear();
}, false);

const setLoadingPrefectures = (loading) => {
  const select = document.querySelector('#selectPrefecture');
  const load = document.querySelector('#divSelectPrefecture .skeleton');
  console.log(loading)
  if (loading) {
    select.classList.add('hidden');
    load.classList.remove('hidden');
    document.getElementById('selectPrefecture').attributes.disabled = true;
  } else {
    select.classList.remove('hidden');
    load.classList.add('hidden');
    document.getElementById('selectPrefecture').attributes.disabled = false;
  }
}

const loadPrefecture = async () => {
  const select = document.getElementById('selectPrefecture');
  setLoadingPrefectures(true);
  try {
    const response = await fetch("prefectures");
    const result = await response.json();
    if (!result.error) {
      select.innerHTML = '';
      const option = document.createElement('option');
      option.value = '';
      option.text = 'Select a prefecture';
      select.appendChild(option);

      result.data.forEach(prefecture => {
        const option = document.createElement('option');
        option.value = prefecture.id;
        option.text = prefecture.name;
        select.appendChild(option);
      });
      setLoadingPrefectures(false);
    } else {
      notyf.error(result.message);
    }
    setLoadingPrefectures(false);
  } catch (error) {
    setLoadingPrefectures(false);
    notyf.error(error);
  }
}

const setLoadingYears = (loading) => {
  const select = document.querySelector('#selectYear');
  const load = document.querySelector('#divSelectYear .skeleton');
  if (loading) {
    select.classList.add('hidden');
    load.classList.remove('hidden');
    document.getElementById('selectYear').attributes.disabled = true;
  } else {
    select.classList.remove('hidden');
    load.classList.add('hidden');
    document.getElementById('selectYear').attributes.disabled = false;
  }
}

const loadYear = async () => {
  const select = document.getElementById('selectYear');
  setLoadingYears(true);
  try {
    const response = await fetch("years");
    const result = await response.json();
    if (!result.error) {
      select.innerHTML = '';
      const option = document.createElement('option');
      option.value = '';
      option.text = 'Select a year';
      select.appendChild(option);

      result.data.forEach(year => {
        const option = document.createElement('option');
        option.value = year.id;
        option.text = year.name;
        select.appendChild(option);
      });
      setLoadingYears(false);
    } else {
      notyf.error(result.message);
    }
    setLoadingYears(false);
  } catch (error) {
    setLoadingYears(false);
    notyf.error(error.message);
  }
}
