import { mount } from '@vue/test-utils';
import { describe, it, expect } from 'vitest';
import HelloWorld from '../resources/js/Pages/HelloWorld.vue';

describe('HelloWorld.vue', () => {
  it('renders the correct message', () => {
    const wrapper = mount(HelloWorld);
    expect(wrapper.text()).toContain('Hello, Vue!');
  });

  it('updates the message when the button is clicked', async () => {
    const wrapper = mount(HelloWorld);
    await wrapper.find('button').trigger('click');
    expect(wrapper.text()).toContain('You clicked the button!');
  });
});